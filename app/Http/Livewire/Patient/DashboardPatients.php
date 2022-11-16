<?php

namespace App\Http\Livewire\Patient;

use App\Models\Clinic;
use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;

class DashboardPatients extends Component
{
    use WithPagination;

    protected $listeners = [ 'refreshParent' => '$refresh' ];

    public $clinics = [];
 
    public function render()
    {
        $patients = Patient::orderBy('id', 'desc')->paginate(10);
        return view('livewire.patient.dashboard-patients', compact('patients'));
    }

    public function mount()
    {
        $this->clinics = Clinic::get();
    }
}
