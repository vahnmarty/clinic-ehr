<?php

namespace App\Http\Livewire\Station\Research;

use App\Enums\FormType;
use Livewire\Component;
use App\Models\Research;
use App\Enums\BooleanOption;
use Filament\Forms\Components\Grid;
use Spatie\Browsershot\Browsershot;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;

class ViewResearchForm extends Component implements HasForms
{
    use InteractsWithForms;
    
    public $view;

    public $form_selected;

    public $patient_id, $research_id;
    
    public function render()
    {
        return view('livewire.station.research.view-research-form');
    }

    public function mount($patientId, $researchId)
    {
        $this->patient_id = $patientId;
        $this->research_id = $researchId;

        $research = Research::where('patient_id', $patientId)->where('id', $researchId)->firstOrFail();

        $this->form_selected = $research->form_type->value;

        if($research->form_type->value == FormType::IntermittentHealthForm)
        {
            $data = $research->intermittent;
            $this->form->fill($data->toArray());
        }
    }

    protected function getFormSchema(): array 
    {
        if($this->form_selected == FormType::IntermittentHealthForm){
            return $this->getIntermittentHealthForm();
        }
       
    }

    public function getIntermittentHealthForm() : array
    {
        return [
            Grid::make(3)
                ->schema([
                    Select::make('has_diarrhea')->label("Has the baby had diarrhea in the last two weeks?")->options(BooleanOption::asSelectArray())->disabled(),
                    Select::make('has_diarrheal_stools')->label("Has the baby had stools with blood or mucus? ")->options(BooleanOption::asSelectArray())->disabled(),
                    Select::make('has_toilet')->label("Has the baby presented more than three diarrheal stools or liquid stools in the last two weeks?")->options(BooleanOption::asSelectArray())->columnSpan('full')->disabled(),
                    Select::make('has_diagnosed_gastrointestinal')->label("Has the baby gone to the toilet more times than usual (even if stools are normal) in the last two weeks?")->options(BooleanOption::asSelectArray())->columnSpan('full')->disabled(),
                    Select::make('has_presented_anything')->label("Has the baby presented with any of the following in the last two weeks?  ")->options(BooleanOption::asSelectArray())->columnSpan('full')->disabled(),
                    TextInput::make('diarrhea_last')->label("How long does the diarrhea last? ")->placeholder('e.g. 10 days')
                ])->disabled(),
            Fieldset::make('Has the baby presented with any of the following in the last two weeks? ')
                ->columns(3)
                ->schema([
                    Checkbox::make('has_cough')->label('Cough')->inline()->disabled(),
                    Checkbox::make('has_respiratory_distress')->label('Intercostal retractions (sinking of ribs)')->inline()->disabled(),
                    Checkbox::make('has_intercostal_retractions')->label('Intercostal retractions (sinking of ribs)')->inline()->disabled(),
                    Checkbox::make('has_fever')->label('Fever')->inline()->disabled(),
                    Checkbox::make('has_rapid_breathing')->label('Fast or rapid breathing?')->inline()->disabled(),
                    Checkbox::make('has_green_yellow_mucous')->label('Green or yellow mucous?')->inline()->disabled(),
                    Checkbox::make('has_hospitalized')->label('Hospitalized in the last 2 weeks')->inline()->disabled(),
                    TextInput::make('days_hospitalized')->label('If yes, number of days hospitalized')
                ])->disabled(),
            Fieldset::make('Have you noticed any of the following symptoms after eating a certain food?')
                ->columns(3)
                ->schema([
                    Checkbox::make('has_no_food_symptoms')->label('None')->inline()->disabled(),
                    Checkbox::make('has_reflux')->label('Refluxx')->inline()->disabled(),
                    Checkbox::make('has_diarrhea_scraps')->label('Diarrhea (with food scraps)')->inline()->disabled(),
                    Checkbox::make('has_abdominal_pain')->label('Adbdominal Pain')->inline()->disabled(),
                    Checkbox::make('has_rash')->label('Rash?')->inline()->disabled(),
                    Checkbox::make('has_glossitis')->label('Glossitis?')->inline()->disabled(),
                    Checkbox::make('has_difficulty_swallowing')->label('Difficulty Swallowing')->inline()->disabled(),
                    Checkbox::make('has_needed_steroid')->label('Has the baby needed to consume any antihistaminic or steroid?')->disabled()
                ])
            
            
        ];
    }

    public function download()
    {
        $url = url('pdf/research', $this->research_id);
        $file = 'export/research_' . $this->research_id . '_' .time() . '.pdf';
        Browsershot::url($url)->save($file);

        return redirect($file);
    }
}
