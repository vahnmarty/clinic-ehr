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
use App\Models\ResearchParentalHistoryForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Forms\Concerns\InteractsWithForms;

class ParentalHistoryForm extends Component implements HasForms
{
    use InteractsWithForms;
    use LivewireAlert;

    public Patient $patient;
    public Application $app;
    public Research $research;

    public $form_type, $is_edit, $research_id;

    
    public $age, $height, $weight, $abdominal_circumference, $bmi, $highest_schooling, $occupation, $marital_relationship;
    public $is_father_with_family,$is_father_expenses,$us_migrant;
    public $department_in_guatemala, $migrant_duration, $is_father_send_remittance, $medical_illness, $age_sexual;
    public $age_first_child, $interpregnancy_period, $children, $partners, $age_when_pregnant;
    public $contraception, $planned_children, $use_alcohol, $use_cigarettes, $other_substance, $family_history_substance, $family_members_of_abuse, $grandparents_health;

    public function render()
    {
        return view('livewire.research.parental-history-form');
    }

    public function mount($patientId, $researchId = null)
    {
        $this->patient_id = $patientId;
        $this->patient = Patient::find($patientId);
        $this->form_type = FormType::ParentalHistoryQuestionairre;

        if($researchId){
            $this->is_edit = true;
            $this->research_id = $researchId;
            $research = Research::with('parental')->find($researchId);
            $this->form->fill($research->parental->toArray());
            $this->research = $research;
        }
    }

    protected function getFormSchema(): array 
    {
        return [
            Grid::make(3)
                ->schema([
                    TextInput::make('age')->numeric(),
                    TextInput::make('height')->label("Height (cm)")->numeric(),
                    TextInput::make('weight')->label("Weight (kg)")->numeric(),
                    TextInput::make('abdominal_circumference')->label("Abdominal Circumference (cm)")->numeric(),
                    TextInput::make('bmi')->label("BMI (calculated)")->numeric(),
                ]),
            Grid::make(3)
                ->schema([
                    TextInput::make('highest_schooling')->label("Highest Level of Schooling"),
                    TextInput::make('occupation')->label("Occupation"),
                    TextInput::make('marital_relationship')->label("Marital Relationship"),
                ]),
            Grid::make(3)
                ->schema([
                    Radio::make('is_father_with_family')
                        ->label('Does the father live with the family?')
                        ->boolean(),
                    Radio::make('is_father_expenses')
                        ->label('Does the father provide expenses for the family?')
                        ->boolean(),
                    Radio::make('us_migrant')
                        ->label('US Migrant')
                        ->boolean(),
                    TextInput::make('department_in_guatemala')->label("Which department in Guatemala?"), 
                    TextInput::make('migrant_duration')->label("If so, how long has he been in a migrant?"),
                    Radio::make('is_father_send_remittance')
                        ->label('Does he send remittance?')
                        ->boolean(),
                    TextInput::make('medical_illness')->label("Any medical illness?"),
                    TextInput::make('age_sexual')->label("Age of starting sexual activity?"),
                    TextInput::make('age_first_child')->label("Age of first child?"),
                    TextInput::make('interpregnancy_period'),
                    TextInput::make('children')->label("Number of children?"),
                    TextInput::make('partners')->label("Number of partners with whom you have children?"),
                    TextInput::make('age_when_pregnant')->label("What age were your partners when pregnant?"),
                ]),
            Placeholder::make('contraception')->label('')
                ->content(new HtmlString('<h3 class="text-2xl font-bold">Contraception</h3>')),      
            Grid::make(3)
                ->schema([
                    TextInput::make('contraception')->label("Do you use any? which one?"),
                    TextInput::make('planned_children')->label("How many children have you planned to have?"),
                ]),
            Placeholder::make('substance')->label('')
                ->content(new HtmlString('<h3 class="text-2xl font-bold">Substance Use</h3>')),      
            Grid::make(3)
                ->schema([
                    Radio::make('use_alcohol')
                        ->label('Alcohol?')
                        ->boolean(),
                    Radio::make('use_cigarettes')
                        ->label('Cigarettes?')
                        ->boolean(),
                    TextInput::make('other_substance')->label("Other"),
                    Radio::make('family_history_substance')
                        ->label('Family history of substance abuse?')
                        ->boolean(),
                    TextInput::make('family_members_of_abuse')->label("Family Members"),
                    TextInput::make('grandparents_health')->label("Grandparents health"),
                ]), 
            
        ];
    } 

    public function save()
    {
        if($this->is_edit){
            return $this->update();
        }
        
        $data = $this->validate();
        $form = new ResearchParentalHistoryForm;
        $form->patient_id = $this->patient->id;
        $form->fill($data);
        $form->save();

        Research::create([
            'patient_id' => $this->patient->id,
            'form_type' => $this->form_type,
            'parental_history_id' => $form->id,
            'created_by' => auth()->id()
        ]);

        $app = Application::wherePatientId($this->patient->id)->latest()->first();
        $app->research_form_finished_at = now();
        $app->research_form_user_id = auth()->id();
        $app->save();

        return redirect()->route('station.research', ['patient_id' => $this->patient_id]);
        
    }

    public function update()
    {
        $data = $this->validate();

        $research = Research::with('parental')->find($this->research_id);
        $form = $research->parental;

        $form->update($data);

        $this->alert('success', 'Form updated successfully!');
        
        // return redirect('station/research/' . $research->patient_id);
    }
}
