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
use App\Http\Livewire\Research\AgriculturalForm;
use App\Http\Livewire\Research\MaternalHealthForm;
use App\Http\Livewire\Research\ParentalHistoryForm;
use App\Http\Livewire\Research\IntermittentHealthForm;

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

        if($research->form_type->value == FormType::ParentalHistoryQuestionairre)
        {
            $data = $research->parental;
            $this->form->fill($data->toArray());
        }

        if($research->form_type->value == FormType::AgriculturalQuestionnaire)
        {
            $data = $research->agricultural;
            $this->form->fill($data->toArray());
        }

    }

    protected function getFormSchema(): array 
    {
        if($this->form_selected == FormType::IntermittentHealthForm){
            return (new IntermittentHealthForm)->getForm();
        }

        if($this->form_selected == FormType::MaternalHealthQuestionairre){
            return (new MaternalHealthForm)->getForm();
        }

        if($this->form_selected == FormType::ParentalHistoryQuestionairre){
            return (new ParentalHistoryForm)->getForm();
        }

        if($this->form_selected == FormType::AgriculturalQuestionnaire){
            return (new AgriculturalForm)->getForm();
        }
       
    }

    public function download()
    {
        $url = url('pdf/research', $this->research_id);
        $file = 'export/research_' . $this->research_id . '_' .time() . '.pdf';
        Browsershot::url($url)->save($file);

        return redirect($file);
    }
}
