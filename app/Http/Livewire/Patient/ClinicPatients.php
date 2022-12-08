<?php

namespace App\Http\Livewire\Patient;

use App\Models\Clinic;
use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ClinicPatient;

class ClinicPatients extends Component
{
    use WithPagination;

    protected $listeners = [ 'refreshParent' => '$refresh' ];

    public $clinics = [], $clinic_id;
 
    public function render()
    {
        $patients = ClinicPatient::with('patient')->orderBy('id', 'desc')->whereClinicId($this->clinic_id)->paginate(10);

        return view('livewire.patient.clinic-patients', compact('patients'));
    }

    public function mount($clinic_id)
    {
        $this->clinic_id = $clinic_id;
        $this->clinics = Clinic::get();
    }

    public function checkInPatient($patient_id)
    {
        $this->emit('selectCheckIn', $patient_id);
    }
}
