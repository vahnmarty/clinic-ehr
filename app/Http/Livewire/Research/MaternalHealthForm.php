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
use App\Models\ResearchMaternalHealthForm;
use Filament\Forms\Components\Placeholder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\ResearchIntermittentHealthForm;
use Filament\Forms\Concerns\InteractsWithForms;

class MaternalHealthForm extends Component implements HasForms
{
    use InteractsWithForms;
    use LivewireAlert;

    public Patient $patient;
    public Application $app;
    public Research $research;

    public $form_type, $is_edit, $research_id;

    public $mother_height, $mother_weight, $abdominal_circumference, $bmi, $highest_schooling, $occupation, $marital_relationship;
    public $menarche_age, $last_menstrual_period, $menstrual_pattern, $menstrual_cycle_length, $menstrual_duration_flow, $menstrual_amount_flow;
    public $has_associated_pain, $has_intermenstrual_bleeding, $has_vasomor_symptoms, $has_hormone_therapy,$has_menopause, $bleeding_pattern;
    public $is_using_contraception, $contraception_method, $previous_contraception;
    public $recent_pap_smear, $has_abnormal_pap_smear, $abnormal_pap_smear_details, $has_infection_history, $has_sti_history,$sti_explanation;
    public $has_vaginitis_history, $vaginitis_explanation, $has_pelvic_disease, $pelvic_disease_explanation, $has_fertility_problems;
    public $fertility_explanation, $desire_future_fertility, $pregnancy_previous_evaluation;

    public function render()
    {
        return view('livewire.research.maternal-health-form');
    }

    public function mount($patientId, $researchId = null)
    {
        $this->patient_id = $patientId;
        $this->patient = Patient::find($patientId);
        $this->form_type = FormType::MaternalHealthQuestionairre;

        if($researchId){
            $this->is_edit = true;
            $this->research_id = $researchId;
            $research = Research::with('maternal')->find($researchId);
            $this->form->fill($research->maternal->toArray());
            $this->research = $research;
        }
    }

    protected function getFormSchema(): array 
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
                        ->label('Vasomor Symptoms')
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

    public function save()
    {
        if($this->is_edit){
            return $this->update();
        }
        
        $data = $this->validate();
        $form = new ResearchMaternalHealthForm;
        $form->patient_id = $this->patient->id;
        $form->fill($data);
        $form->save();

        Research::create([
            'patient_id' => $this->patient->id,
            'form_type' => $this->form_type,
            'maternal_health_id' => $form->id,
            'created_by' => auth()->id()
        ]);

        $app = Application::wherePatientId($this->patient->id)->latest()->first();
        $app->research_form_finished_at = now();
        $app->research_form_user_id = auth()->id();
        $app->save();

        return redirect()->route('station.research', $this->patient_id);
        
    }

    public function update()
    {
        $data = $this->validate();

        $research = Research::with('maternal')->find($this->research_id);
        $form = $research->maternal;

        $form->update($data);

        $this->alert('success', 'Form updated successfully!');
        
        // return redirect('station/research/' . $research->patient_id);
    }
}
