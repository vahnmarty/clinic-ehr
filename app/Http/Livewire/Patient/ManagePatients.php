<?php

namespace App\Http\Livewire\Patient;

use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;

class ManagePatients extends Component
{
    use WithPagination;

    protected $listeners = [ 'refreshParent' => '$refresh' ];
 
    public function render()
    {
        $patients = Patient::orderBy('id', 'desc')->paginate(10);
        return view('livewire.patient.manage-patients', compact('patients'));
    }
}
