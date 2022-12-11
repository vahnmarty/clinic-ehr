<?php

namespace App\Http\Livewire\Station;

use Livewire\Component;
use App\Models\MedicalCode;
use App\Http\Livewire\Station\SearchPatientTrait;

class ClinicalEncounter extends Component
{
    use SearchPatientTrait;

    protected $listeners = ['selectPatient'];

    public $vital_sign, $medications;
    
    public function render()
    {
        return view('livewire.station.clinical-encounter');
    }

    public function mount()
    {
        $this->selectPatient(82);

        $this->vital_sign = $this->patient->vitalSigns()->latest()->first();
    
    }
    
    
}
