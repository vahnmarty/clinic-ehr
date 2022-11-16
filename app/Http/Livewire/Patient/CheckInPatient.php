<?php

namespace App\Http\Livewire\Patient;

use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Patient;
use Livewire\Component;
use App\Models\ClinicPatient;

class CheckInPatient extends Component
{
    public $doctors = [];
    public $clinics = [];

    public $visit_reason, $clinic_id, $doctor_id, $patient_id, $patient;

    protected $listeners = [ 'selectCheckIn' => 'setPatient'];

    protected $rules = [
        'visit_reason' => 'required',
        'clinic_id' => 'required',
        'doctor_id' => 'required',
        'patient_id' => 'required'
    ];

    public function render()
    {
        return view('livewire.patient.check-in-patient');
    }

    public function mount()
    {
        $this->doctors = Doctor::get();
        $this->clinics = Clinic::get();
    }

    public function save()
    {
        $data = $this->validate();
        
        $patient = new ClinicPatient;
        $patient->fill($data);
        $patient->save();

    }

    public function setPatient($patient_id)
    {
        $this->patient_id = $patient_id;
        $this->patient = Patient::find($patient_id);

        $this->dispatchBrowserEvent('openmodal-checkin');
    }

    public function saveAndClose()
    {
        $this->save();

        $this->dispatchBrowserEvent('closemodal-checkin');
    }

    public function saveThenDashboard()
    {
        $this->save();

        return redirect()->to('dashboard?clinic_id=' . $this->clinic_id);
    }
}
