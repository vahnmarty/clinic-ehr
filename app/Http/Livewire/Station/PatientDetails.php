<?php

namespace App\Http\Livewire\Station;

use Livewire\Component;
use App\Models\Application;
use App\Enums\RacialIdentity;
use App\Enums\PrimaryLanguage;
use Filament\Forms\Components\Grid;

use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Http\Livewire\Station\SearchPatientTrait;

class PatientDetails extends Component implements HasForms
{
    use SearchPatientTrait;
    use InteractsWithForms;
    use LivewireAlert;

    public $step = 'basic';

    protected $listeners = ['selectPatient' , 'confirmMedicalHistory'];

    public $patient_number, $first_name, $last_name, $email, $date_of_birth;

    public function render()
    {
        return view('livewire.station.patient-details');
    }

    public function mount()
    {
        
    }

    public function fillFilamentForm()
    {
        if($this->patient){
            $this->form->fill($this->patient->toArray());
        }
    }

    protected function getFormSchema(): array 
    {
        return [
            Grid::make(3)
                ->schema([
                    TextInput::make('patient_number')->required(),
                ]),
            Grid::make(3)
                ->schema([
                    TextInput::make('first_name')->required(),
                    TextInput::make('last_name')->required(),
                ]),
            Grid::make(3)
                ->schema([
                    TextInput::make('email'),
                    TextInput::make('cellphone'),
                ]),
            Grid::make(3)
                ->schema([
                    DatePicker::make('date_of_birth')->required(),
                    Select::make('sex')->options(['male' => 'Male', 'female' => 'Female'])->required(),
                ]),
            
            Grid::make(3)
                ->schema([
                    TextInput::make('dpi_number'),
                    Select::make('identity')->options(RacialIdentity::asSelectArray())->required(),
                    Select::make('primary_language')->options(PrimaryLanguage::asSelectArray())->required(),
                ]),
            Fieldset::make('Demographics')
                ->schema([
                    TextInput::make('address1')->required(),
                    TextInput::make('address2'),
                    TextInput::make('city')->required(),
                    TextInput::make('state')->required(),
                    TextInput::make('zip_code')->required(),
                ])
                ->columns(3),
            Fieldset::make('Birth Info')
                ->schema([
                    TextInput::make('birth_weight')->label('Birth Weight (kg)')->required()->numeric(),
                    TextInput::make('birth_length')->label('Birth Length (cm)')->required()->numeric(),
                    TextInput::make('apgar_score')->label('Apgars')->required()->numeric(),
                    TextInput::make('age_started_solid_food')->label('Age when starting solid food')->required()->numeric(),
                    Fieldset::make('Check if Yes')->schema([
                        Checkbox::make('skin_to_skin')->label('Skin to Skin immediately')->inline(),
                        Checkbox::make('immediate_breastfeeding')->inline(),
                        Checkbox::make('history_of_respiratory_distress')->inline(),
                        Checkbox::make('jaundice')->inline(),
                        Checkbox::make('sepsis')->inline(),
                        Checkbox::make('infant_required_hospitalization')->inline(),
                        Checkbox::make('fresh_fruit')->inline(),
                    ])
                ])
        ];
    }

    public function save()
    {
        $data = $this->validate();

        $this->patient->update($data);

        $this->alert('success', 'Patient updated successfully!');

        $this->next('parents');
    }

    public function next($step)
    {
        $this->step = $step;
    }

    public function saveParents()
    {
        if( !$this->patient->guardians()->count()){
            $this->alert('error', 'No parents/guardian.');
            return;
        }

        return $this->next('medical');
    }

    public function promptMedicalHistory()
    {
        $this->alert('question', "This is the last step for Patient's Information.  Done with the Medical History?", [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, Save changes',
            'onConfirmed' => 'confirmMedicalHistory' 
        ]);
    }

    public function confirmMedicalHistory()
    {
        $app = Application::where('patient_id', $this->patient_id)->latest()->first();
        $app->patient_info_finished_at = now();
        $app->patient_info_user_id = auth()->id();
        $app->save();
        
        $this->alert('success', 'Patient Information updated successfully!', ['timer' => 3000]);

        $this->dispatchBrowserEvent('refresh-browser');
        
    }
    
}
