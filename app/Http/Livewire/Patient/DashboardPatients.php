<?php

namespace App\Http\Livewire\Patient;

use App\Models\Clinic;
use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DashboardPatients extends Component
{
    use WithPagination;

    use LivewireAlert;

    protected $listeners = [ 'refreshParent' => '$refresh', 'confirmDelete' => 'destroy' ];

    public $clinics = [];

    public $delete_patient_id;
 
    public function render()
    {
        $patients = Patient::orderBy('id', 'desc')->paginate(10);
        return view('livewire.patient.dashboard-patients', compact('patients'));
    }

    public function mount()
    {
        $this->clinics = Clinic::get();
    }

    public function checkInPatient($patient_id)
    {
        $this->emit('selectCheckIn', $patient_id);
    }

    public function destroy()
    {
        Patient::destroy($this->delete_patient_id);

        $this->reset('delete_patient_id');

        $this->alert('success', 'Patient removed successfully!');
    }

    public function deletePatient($patientId)
    {
        $this->delete_patient_id = $patientId;

        $this->alert('question', 'Are you sure you want to delete this patient?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, confirm delete',
            'onConfirmed' => 'confirmDelete',
        ]);
    }
    
}
