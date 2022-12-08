<?php

namespace App\Http\Livewire\Station;

use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Application;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Forms\Concerns\InteractsWithForms;

class CheckIn extends Component  implements HasForms
{

    use InteractsWithForms;

    use LivewireAlert;

    public $type, $search;

    public $patient_id, $patient;

    public $clinic_id, $visit_reason, $doctor_id;

    protected $queryString = ['patient_id'];

    public function render()
    {
        $results = $this->search ? Patient::search($this->search)->get() : [];
        
        return view('livewire.station.check-in', compact('results'));
    }

    public function mount()
    {
        if($this->patient_id)
        {
            $this->type = 'old';
            $this->setPatient($this->patient_id);
        }
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
                    Select::make('doctor_id')->label('Doctor')->options(Doctor::all()->pluck('name', 'id'))->required(),
                ]),
            
        ];
    }


    public function save()
    {
        $data = $this->validate();

        $app = new Application;
        $app->uuid = \Str::uuid();
        $app->patient_id = $this->patient_id;
        $app->fill($data);
        $app->check_in_at = now();
        $app->check_in_user_id = auth()->id();
        $app->save();
        
        $this->alert('success', 'Checked-in successfully. Proceed to Step 2: Update Patient Information');

        $this->reset();
    }
}
