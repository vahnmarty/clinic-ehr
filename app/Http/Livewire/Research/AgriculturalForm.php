<?php

namespace App\Http\Livewire\Research;

use App\Enums\FormType;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Research;
use App\Models\Application;
use App\Enums\BooleanOption;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use App\Models\ResearchAgriculturalForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Forms\Concerns\InteractsWithForms;

class AgriculturalForm extends Component implements HasForms
{
    use InteractsWithForms;
    use LivewireAlert;

    public Patient $patient;
    public Application $app;
    public Research $research;

    public $form_type, $is_edit, $research_id;

    
    public $has_available_land, $rent_status, $area_size, $area_land, $has_irrigation_farm, $has_grow_food, $crops_type;
    public $animal_husbandry, $animal_husbandry_type, $immunization, $is_compost, $compost_seeds, $using_fertilisers;
    public $decrease_production, $has_pets, $pets_explanation;

    public function render()
    {
        return view('livewire.research.agricultural-form');
    }

    public function mount($patientId, $researchId = null)
    {
        $this->patient_id = $patientId;
        $this->patient = Patient::find($patientId);
        $this->form_type = FormType::AgriculturalQuestionnaire;

        if($researchId){
            $this->is_edit = true;
            $this->research_id = $researchId;
            $research = Research::with('agricultural')->find($researchId);
            $this->form->fill($research->agricultural->toArray());
            $this->research = $research;
        }
    }

    public function getForm()
    {
        return $this->getFormSchema();
    }

    protected function getFormSchema(): array 
    {
        return [
            Grid::make(3)
                ->schema([
                    Radio::make('has_available_land')
                        ->label('Do you have available land for growing food?')
                        ->boolean(),
                    Select::make('rent_status')->label('Do you own or rent?')->options(['Rent' => 'Rent', 'Own' => 'Own']),
                    TextInput::make('area_size')->placeholder('e.g. 2500 sq ft'),
                    TextInput::make('area_land'),
                    Radio::make('has_irrigation_farm')
                        ->label('Does it have irrigation for your farm?')
                        ->boolean(),
                    Radio::make('has_grow_food')
                        ->label('Do you grow food on your own?')
                        ->boolean(),
                    TextInput::make('crops_type')->label('What kind of crops do you have?'),
                    Radio::make('animal_husbandry')
                        ->label('Do you have animal husbandry?')
                        ->boolean(),
                    TextInput::make('animal_husbandry_type')->label('Type?'),
                    TextInput::make('immunization')->label('Immunization?'),
                    Radio::make('is_compost')
                        ->label('Do you compost? ?')
                        ->boolean(),
                    TextInput::make('compost_seeds')->label('What kind of seed do you use?'),
                    Radio::make('using_fertilisers')
                        ->label('Do you use fertilisers or pesticides in your land?')
                        ->boolean(),
                    Radio::make('decrease_production')
                        ->label('Have you noticed any decrease in your production?')
                        ->boolean()->columnSpan(2),
                    Radio::make('has_pets')
                        ->label('Do you have pets?')
                        ->boolean(),
                    TextInput::make('pets_explanation')->label("Explain")->columnSpan(2)
                    
                ]),
            
        ];
    } 

    public function save()
    {
        if($this->is_edit){
            return $this->update();
        }
        
        $data = $this->validate();
        $form = new ResearchAgriculturalForm;
        $form->patient_id = $this->patient->id;
        $form->fill($data);
        $form->save();

        Research::create([
            'patient_id' => $this->patient->id,
            'form_type' => $this->form_type,
            'agricultural_id' => $form->id,
            'created_by' => auth()->id()
        ]);

        $app = Application::wherePatientId($this->patient->id)->latest()->first();
        $app->research_form_finished_at = now();
        $app->research_form_user_id = auth()->id();
        $app->save();

        return redirect()->route('station.research', ['patientId' => $this->patient_id]);
        
    }

    public function update()
    {
        $data = $this->validate();

        $research = Research::with('agricultural')->find($this->research_id);
        $form = $research->agricultural;

        $form->update($data);

        $this->alert('success', 'Form updated successfully!');
    }
}
