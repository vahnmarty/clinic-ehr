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
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\ResearchIntermittentHealthForm;
use Filament\Forms\Concerns\InteractsWithForms;

class MaternalHealthForm extends Component implements HasForms
{
    use InteractsWithForms;
    use LivewireAlert;

    public Patient $patient;
    public Application $app;

    public $form_type, $is_edit, $research_id;

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
                        ->label('Associated pain? ')
                        ->boolean(),
                    Radio::make('has_hormone_therapy')
                        ->label('On hormone replacement therapy? ')
                        ->boolean(),
                    Radio::make('has_menopause')
                        ->label('Menopause')
                        ->boolean(),
                    TextInput::make('bleeding_pattern'),
                ]),    
            
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

        $this->app->researches()->create([
            'patient_id' => $this->patient->id,
            'form_type' => $this->form_type,
            'intermittent_form_id' => $form->id,
            'created_by' => auth()->id()
        ]);

        return redirect('station/research');
        
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
