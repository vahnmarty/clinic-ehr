<?php

namespace App\Http\Livewire\Patient;

use App\Models\Patient;
use Livewire\Component;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Forms\Concerns\InteractsWithForms;

class EditPatient extends Component implements HasForms
{
    use InteractsWithForms;

    use LivewireAlert;

    public Patient $patient;
    
    public $patient_id, $first_name, $last_name, $email, $date_of_birth;
    
    public function render()
    {
        return view('livewire.patient.edit-patient');
    }

    public function mount($id)
    {
        $this->patient = Patient::find($id);

        $this->form->fill($this->patient->toArray());
    }

    protected function getFormSchema(): array 
    {
        return [
            Grid::make(3)
                ->schema([
                    TextInput::make('patient_id')->required(),
                ]),
            Grid::make(3)
                ->schema([
                    TextInput::make('first_name')->required(),
                    TextInput::make('last_name')->required(),
                ]),
            Grid::make(3)
                ->schema([
                    TextInput::make('email')->required(),
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
                    TextInput::make('identity'),
                    Select::make('primary_language')->options(['en' => 'English', 'es' => 'Spanish'])->required(),
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

    public function submit()
    {
        $data = $this->validate();
        
        $this->patient->update($data);

        $this->alert('success', 'Patient information updated successfuly.');
        
    }
}
