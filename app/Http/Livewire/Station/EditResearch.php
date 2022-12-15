<?php

namespace App\Http\Livewire\Station;

use App\Enums\FormType;
use Livewire\Component;
use App\Models\Research;

class EditResearch extends Component
{
    public function render()
    {
        return view('livewire.station.edit-research');
    }

    public function mount($researchId)
    {
        $research = Research::findOrFail($researchId);
        
        if($research->form_type->value == FormType::IntermittentHealthForm)
        {
            return redirect('station/research/' . $research->patient_id . '/IntermittentHealthForm/' . $research->id . '/edit');
        }

        if($research->form_type->value == FormType::MaternalHealthQuestionairre)
        {
            return redirect('station/research/' . $research->patient_id . '/MaternalHealthQuestionairre/' . $research->id . '/edit');
        }
    }
}
