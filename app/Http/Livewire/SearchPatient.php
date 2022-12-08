<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Livewire\Component;

class SearchPatient extends Component
{
    public $search;

    public function render()
    {
        $results = $this->search ? Patient::search($this->search)->get() : [];
        return view('livewire.search-patient', compact('results'));
    }

    public function setPatient($id)
    {
        $this->emit('selectPatient', $id);
        $this->dispatchBrowserEvent('closemodal-search');
    }
}
