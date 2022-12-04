<?php

namespace App\Http\Livewire\Patient;

use App\Models\Patient;
use Livewire\Component;
use Filament\Forms\Components\Grid;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Forms\Concerns\InteractsWithForms;

class ShowPrenatalHistory extends Component implements HasForms
{
    use InteractsWithForms;

    use LivewireAlert;

    public $patient_id;

    public $prenatal_course, $pregnancy_number, $hish_risk, $abortion_risk, $premature_parturition_risk, $diagnosis;

    public function render()
    {
        return view('livewire.patient.show-prenatal-history');
    }

    public function mount($patientId)
    {
        $this->patient_id = $patientId;

        $patient = Patient::with('prenatal')->find($patientId);

        $this->form->fill($patient->prenatal?->toArray());
    }

    protected function getFormSchema(): array 
    {
        return [
            Grid::make(3)
                ->schema([
                    TextInput::make('prenatal_course')->required(),
                    TextInput::make('pregnancy_number')->required(),
                ]),
            Grid::make(3)
                ->schema([
                    Fieldset::make('Risks')->schema([
                        Checkbox::make('high_risk')->label('High Risk')->inline(),
                        Checkbox::make('abortion_risk')->label('Risk of Abortion')->inline(),
                        Checkbox::make('premature_parturition_risk')->label('Risk of Premature Parturition')->inline(),
                    ])
                ]),
            Grid::make(1)
                ->schema([
                    Textarea::make('diagnosis')->rows(2)->nullable(),
                ]),
            ];
    }

    public function save()
    {
        $data = $this->validate();
        $patient = Patient::find($this->patient_id);

        if($patient->prenatal){

            $patient->prenatal->update($data);
    
        }else{
            $patient->prenatal()->create($data);
        }

        $this->alert('success', "Patient's Prenatal History updated successfuly.");

        $this->dispatchBrowserEvent('closemodal-prenatal-history');

        $this->emitUp('refreshParent');
        
    }
}
