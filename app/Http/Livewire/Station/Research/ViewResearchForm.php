<?php

namespace App\Http\Livewire\Station\Research;

use App\Enums\FormType;
use Livewire\Component;
use App\Models\Research;
use App\Enums\BooleanOption;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Grid;
use Spatie\Browsershot\Browsershot;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Concerns\InteractsWithForms;

class ViewResearchForm extends Component implements HasForms
{
    use InteractsWithForms;
    
    public $view;

    public $form_selected, $form_type;

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

        $this->form_type = $research->form_type->description;
        $this->form_selected = $research->form_type->value;

        if($research->form_type->value == FormType::IntermittentHealthForm)
        {
            $data = $research->intermittent;
            $this->form->fill($data->toArray());
        }

        if($research->form_type->value == FormType::MaternalHealthQuestionairre)
        {
            $data = $research->maternal;
            $this->form->fill($data->toArray());
        }
    }

    protected function getFormSchema(): array 
    {
        if($this->form_selected == FormType::IntermittentHealthForm){
            return $this->getIntermittentHealthForm();
        }

        if($this->form_selected == FormType::MaternalHealthQuestionairre){
            return $this->getMaternalHealthForm();
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

    public function getMaternalHealthForm() : array
    {
        return [
            Grid::make(3)
                ->schema([
                    TextInput::make('mother_height')->label("Mother's Height (cm)")->numeric(),
                    TextInput::make('mother_weight')->label("Mother's Weight (kg)")->numeric(),
                    TextInput::make('abdominal_circumference')->label("Abdominal Circumference (cm)")->numeric(),
                    TextInput::make('bmi')->label("BMI (calculated)")->numeric(),
                ]),
            Grid::make(3)
                ->schema([
                    TextInput::make('highest_schooling')->label("Highest Level of Schooling"),
                    TextInput::make('occupation')->label("Occupation"),
                    TextInput::make('marital_relationship')->label("Marital Relationship"),
                ]),
            Placeholder::make('maternal_gyn')->label('')
                ->content(new HtmlString('<h3 class="text-2xl font-bold">Maternal Gyn History</h3>')),      
            Grid::make(3)
                ->schema([
                    TextInput::make('menarche_age')->label("Age at Menarche: (years)"),
                    DatePicker::make('last_menstrual_period')->label("Last Menstrual Period (date)"),
                    TextInput::make('menstrual_pattern')->label("Menstrual Pattern"),
                    TextInput::make('menstrual_cycle_length')->label("Cycle Length"),
                    TextInput::make('menstrual_duration_flow')->label("Duration of flow"),
                    TextInput::make('menstrual_amount_flow')->label("Amount of flow"),
                ]),   
            Grid::make(3)
                ->schema([
                    Radio::make('has_associated_pain')
                        ->label('Associated pain? ')
                        ->boolean(),
                    Radio::make('has_intermenstrual_bleeding')
                        ->label('Intermenstrual Bleeding?')
                        ->boolean(),
                    Radio::make('has_vasomor_symptoms')
                        ->label('Associated pain? ')
                        ->boolean(),
                    Radio::make('has_hormone_therapy')
                        ->label('On hormone replacement therapy? ')
                        ->boolean(),
                    Radio::make('has_menopause')
                        ->label('Menopause')
                        ->boolean(),
                    TextInput::make('bleeding_pattern'),
                    Radio::make('is_using_contraception')
                        ->label('Are you on contraception?')
                        ->boolean(),
                    TextInput::make('contraception_method')->label('Which Method'),
                    TextInput::make('previous_contraception')->label('Previous methods use? '),
                ]),
            Grid::make(3)
                ->schema([
                    TextInput::make('recent_pap_smear')->label('Most recent pap smear result')->columnSpan(3),
                    Radio::make('has_abnormal_pap_smear')
                        ->label('History of Abnormal Pap smears?')
                        ->boolean(),
                    TextInput::make('abnormal_pap_smear_details')->label('Nature/Diagnosis/Treatment and f/u')->columnSpan(2),
                    Radio::make('has_infection_history')
                        ->label('History of infections?')
                        ->boolean()
                        ->columnSpan('full'),
                    Radio::make('has_sti_history')
                        ->label('History of STI?')
                        ->boolean(),
                    TextInput::make('sti_explanation')->label('Explain')->columnSpan(2),
                    Radio::make('has_vaginitis_history')
                        ->label('History of Vaginitis?')
                        ->boolean(),
                    TextInput::make('vaginitis_explanation')->label('Include Types')->columnSpan(2),
                    Radio::make('has_pelvic_disease')
                        ->label('History of Pelvic Inflammatory Diseases?')
                        ->boolean(),
                    TextInput::make('pelvic_disease_explanation')->label('Include Types')->columnSpan(2),
                    Radio::make('has_fertility_problems')
                        ->label("We're there fertility problems")
                        ->boolean(),
                    TextInput::make('fertility_explanation')->label('Include Types')->columnSpan(2),
                    Radio::make('desire_future_fertility')
                        ->label("Do you have a desire for future fertility?")
                        ->boolean(),
                    TextInput::make('pregnancy_previous_evaluation')->label('Any difficulty conceiving in the past: if so, prior evaluation and treatments?')->columnSpan(2),
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
