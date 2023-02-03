<?php

namespace App\Http\Livewire\Station;

use Closure;
use App\Models\User;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Application;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\DateTimePicker;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Forms\Concerns\InteractsWithForms;
use Carbon\Carbon;

class CheckIn extends Component  implements HasForms
{

    use InteractsWithForms;

    use LivewireAlert;

    public $type, $search;

    public $patientId, $patient_id, $patient;

    public $clinic_id, $visit_reason, $doctor_id, $appointment_date;

    public $schedules = [], $schedule, $hour_slot, $minute_slot, $hour_selected, $time_slots = [];

    protected $queryString = ['patient_id', 'type', 'patientId'];

    public function render()
    {
        $results = $this->search ? Patient::search($this->search)->get() : [];
        
        return view('livewire.station.check-in', compact('results'));
    }

    public function mount()
    {
        if($this->patientId){
            $this->patient_id = $this->patientId;
        }

        if($this->patient_id)
        {
            $this->type = 'old';
            $this->setPatient($this->patient_id);
        }

        $this->generateSchedules();
    }

    public function generateSchedules()
    {
        $intervals = array();
        $intervals = array();

        for ($i = 7; $i < 19; $i++) {
            $hour = ($i % 12 == 0) ? 12 : $i % 12;
            $start = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00';
            $hour = ($hour % 12) + 1;
            $ampm_start = ($i < 12) ? 'AM' : 'PM';
            $intervals[$start] = "$start $ampm_start";
        }


        $this->schedules = $intervals;
    }

    public function setPatient($patientId)
    {
        $this->patient_id = $patientId;
        $this->patient = Patient::find($patientId);
    }

    protected function getFormSchema(): array 
    {
        return [
            Grid::make(3)
                ->schema([
                    Select::make('clinic_id')->label('Clinic')->options(Clinic::all()->pluck('name', 'id'))->required(),
                    TextInput::make('visit_reason')->label('Visit Reason')->required(),
                    Select::make('doctor_id')->reactive()->label('Doctor')->options(User::role('provider')->get()->pluck('name', 'id'))->required(),
                    DatePicker::make('appointment_date')
                    ->default(date('Y-m-d'))
                    ->minDate(now())
                    ->reactive()
                    ->hidden(fn (Closure $get) => $get('doctor_id') === null),
                    Select::make('hour_slot')->options($this->schedules)
                    ->reactive()
                    ->label('Schedule')
                    ->afterStateUpdated(function (Closure $set, $state) {
                        $this->reset('time_slots');
                        foreach([15, 30, 45] as $interval)
                        {
                            $date = Carbon::parse($this->appointment_date)->format('Y-m-d') . ' ' . $state . ':00';
                            $newDate = Carbon::parse($date)->addMinutes($interval)->format('Y-m-d H:i:00');

                            if($this->availableSchedule($newDate))
                            {   
                                $time = Carbon::parse($newDate)->format('H:i A');
                                $this->time_slots[$time] = $time;
                            }
                            
                        }

                    })
                    ->hidden(fn (Closure $get) => $get('appointment_date') === null),
                    Select::make('minute_slot')->reactive()->options(function () {
                        return $this->time_slots;
                    })->label('Available Time Slot')
                    ->hidden(fn (Closure $get) => $get('hour_slot') === null),
                ]),
            
        ];
    }

    public function availableSchedule($date)
    {
        $doctor_id = $this->doctor_id;

        return Application::where('appointment_date', $date)->where('doctor_id', $doctor_id)->exists() ? false : true;


    }

    public function save()
    {
        $data = $this->validate();

        $appointment_date = Carbon::parse($this->appointment_date)->format('Y-m-d');
        $newDate = Carbon::parse($appointment_date. ' ' . $this->minute_slot)->format('Y-m-d H:i:00 A');

        $app = new Application;
        $app->uuid = \Str::uuid();
        $app->patient_id = $this->patient_id;
        $app->clinic_id = $this->clinic_id;
        $app->visit_reason = $this->visit_reason;
        $app->doctor_id = $this->doctor_id;
        $app->appointment_date = $newDate;
        $app->check_in_at = now();
        $app->check_in_user_id = auth()->id();
        $app->save();

        return redirect()->route('patient.show', $this->patient_id);
        
        $this->alert('success', 'Checked-in successfully. Proceed to Step 2: Update Patient Information');

        $this->reset();
    }
}
