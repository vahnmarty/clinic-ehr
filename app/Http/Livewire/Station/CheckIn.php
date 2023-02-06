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

    public $schedules = [], $schedule, $hour_slot, $minute_slot, $hour_selected, $time_slots = [], $time_slot, $default_time_slot;

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

        $this->schedules = $this->time_slots;
    }

    public function generateSchedules()
    {
        $intervals = array();
        $intervals = array();

        for ($i = 6; $i < 17; $i++) {
            $hour = ($i % 12 == 0) ? 12 : $i % 12;
            $hour = ($hour % 12) + 1;
            $ampm_start = ($i < 12) ? 'AM' : 'PM';

            $start1 = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00';
            $start2 = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':15';
            $start3 = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':30';
            $start4 = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':45';
            $intervals[$start1 . ':00'] = "$start1 $ampm_start";
            $intervals[$start2 . ':00'] = "$start2 $ampm_start";
            $intervals[$start3 . ':00'] = "$start3 $ampm_start";
            $intervals[$start4 . ':00'] = "$start4 $ampm_start";
        }
        
        $this->time_slots = $intervals;
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
                    ->label('Schedule')
                    ->afterStateUpdated(function (Closure $set, $state) {
                        $date = date('Y-m-d', strtotime($state));
                        $taken = $this->timeWithAppointments($date);
                        $slots = [];
                        $default = 0;
                        foreach($this->time_slots as $i => $sched)
                        {   
                            if(!in_array($sched, $taken))
                            {
                                if($default == 0){
                                    $this->default_time_slot = $i;
                                    $default++;
                                }
                                $slots[$i] = $sched;
                            }
                        }

                        $this->reset('schedules');
                        $this->schedules = $slots;
                        $set('time_slot', $this->default_time_slot);
                    })
                    ->hidden(fn (Closure $get) => $get('doctor_id') === null),
                    Select::make('time_slot')
                    ->options(function () {
                        return $this->schedules;
                    })
                    ->reactive()
                    ->label('Schedule')
                    ->hidden(function(Closure $get, Closure $set){
                        //$set('time_slot', $this->default_time_slot);
                        return $get('appointment_date') === null;
                    })
                ]),
            
        ];
    }

    public function availableSchedule($date)
    {
        $doctor_id = $this->doctor_id;

        return Application::where('appointment_date', $date)->where('doctor_id', $doctor_id)->exists() ? false : true;
    }

    public function timeWithAppointments($date)
    {
        $time_slots = [];
        $doctor_id = $this->doctor_id;
        $appointments = Application::whereDate('appointment_date', $date)->where('doctor_id', $doctor_id)->get();
        
        foreach($appointments as $app)
        {
            $time_slots[] = $app->appointment_date->format('h:i A');
        }

        return $time_slots;
    }

    public function save()
    {
        $data = $this->validate();

        $appointment_date = Carbon::parse($this->appointment_date)->format('Y-m-d');
        $newDate = Carbon::parse($appointment_date. ' ' . $this->time_slot)->format('Y-m-d H:i:00 A');

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
