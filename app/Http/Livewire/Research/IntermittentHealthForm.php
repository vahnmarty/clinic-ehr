<?php

namespace App\Http\Livewire\Research;

use App\Enums\FormType;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Research;
use App\Models\Application;
use App\Enums\BooleanOption;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\ResearchIntermittentHealthForm;
use Filament\Forms\Concerns\InteractsWithForms;

class IntermittentHealthForm extends Component implements HasForms
{
    use InteractsWithForms;
    use LivewireAlert;

    public Patient $patient;
    public Application $app;

    public $form_type, $is_edit, $research_id;

    public $has_diarrhea, $has_diarrheal_stools, $has_toilet, $has_diagnosed_gastrointestinal, $has_presented_anything, $diarrhea_last;
    
    public $has_cough, $has_fever, $has_hospitalized, $days_hospitalized, $has_respiratory_distress, $has_rapid_breathing, $has_intercostal_retractions, $has_green_yellow_mucous;

    public $has_no_food_symptoms, $has_abdominal_pain, $has_difficulty_swallowing, $has_reflux, $has_rash, $has_needed_steroid, $has_diarrhea_scraps, $has_glossitis;

    public function render()
    {
        return view('livewire.research.intermittent-health-form');
    }

    public function mount($patientId, $researchId = null)
    {
        $this->patient_id = $patientId;
        $this->patient = Patient::find($patientId);
        $this->form_type = FormType::IntermittentHealthForm;

        if($researchId){
            $this->is_edit = true;
            $this->research_id = $researchId;
            $research = Research::with('intermittent')->find($researchId);
            $this->form->fill($research->intermittent->toArray());
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
                    Select::make('has_diarrhea')->label("Has the baby had diarrhea in the last two weeks?")->options(BooleanOption::asSelectArray()),
                    Select::make('has_diarrheal_stools')->label("Has the baby had stools with blood or mucus? ")->options(BooleanOption::asSelectArray()),
                    Select::make('has_toilet')->label("Has the baby presented more than three diarrheal stools or liquid stools in the last two weeks?")->options(BooleanOption::asSelectArray())->columnSpan('full'),
                    Select::make('has_diagnosed_gastrointestinal')->label("Has the baby gone to the toilet more times than usual (even if stools are normal) in the last two weeks?")->options(BooleanOption::asSelectArray())->columnSpan('full'),
                    Select::make('has_presented_anything')->label("Has the baby presented with any of the following in the last two weeks?  ")->options(BooleanOption::asSelectArray())->columnSpan('full'),
                    TextInput::make('diarrhea_last')->label("How long does the diarrhea last? ")->placeholder('e.g. 10 days')
                ]),
            Fieldset::make('Has the baby presented with any of the following in the last two weeks? ')
                ->columns(3)
                ->schema([
                    Checkbox::make('has_cough')->label('Cough')->inline(),
                    Checkbox::make('has_respiratory_distress')->label('Respiratory distress')->inline(),
                    Checkbox::make('has_intercostal_retractions')->label('Intercostal retractions (sinking of ribs)')->inline(),
                    Checkbox::make('has_fever')->label('Fever')->inline(),
                    Checkbox::make('has_rapid_breathing')->label('Fast or rapid breathing?')->inline(),
                    Checkbox::make('has_green_yellow_mucous')->label('Green or yellow mucous?')->inline(),
                    Checkbox::make('has_hospitalized')->label('Hospitalized in the last 2 weeks')->inline(),
                    TextInput::make('days_hospitalized')->label('If yes, number of days hospitalized')
                ]),
            Fieldset::make('Have you noticed any of the following symptoms after eating a certain food?')
                ->columns(3)
                ->schema([
                    Checkbox::make('has_no_food_symptoms')->label('None')->inline(),
                    Checkbox::make('has_reflux')->label('Reflux')->inline(),
                    Checkbox::make('has_diarrhea_scraps')->label('Diarrhea (with food scraps)')->inline(),
                    Checkbox::make('has_abdominal_pain')->label('Abdominal Pain')->inline(),
                    Checkbox::make('has_rash')->label('Rash?')->inline(),
                    Checkbox::make('has_glossitis')->label('Glossitis?')->inline(),
                    Checkbox::make('has_difficulty_swallowing')->label('Difficulty Swallowing')->inline(),
                    Checkbox::make('has_needed_steroid')->label('Has the baby needed to consume any antihistaminic or steroid?')
                ])
            
            
        ];
    } 

    public function save()
    {
        

        if($this->is_edit){
            return $this->update();
        }
        $data = $this->validate();
        $form = new ResearchIntermittentHealthForm;
        $form->patient_id = $this->patient->id;
        $form->fill($data);
        $form->save();

        Research::create([
            'patient_id' => $this->patient->id,
            'form_type' => $this->form_type,
            'intermittent_form_id' => $form->id,
            'created_by' => auth()->id()
        ]);

        // $app = Application::wherePatientId($this->patient->id)->latest()->first();
        // $app->research_form_finished_at = now();
        // $app->research_form_user_id = auth()->id();
        // $app->save();

        return redirect()->route('station.research', ['patientId' => $this->patient_id]);
        
    }

    public function update()
    {
        $data = $this->validate();

        $research = Research::with('intermittent')->find($this->research_id);
        $form = $research->intermittent;

        $form->update($data);

        $this->alert('success', 'Form updated successfully!');
        
        // return redirect('station/research/' . $research->patient_id);
    }
}
