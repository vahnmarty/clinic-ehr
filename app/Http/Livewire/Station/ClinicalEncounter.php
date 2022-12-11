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
        if(!$this->vital_sign){
            if($this->patient){
                $this->vital_sign = $this->patient->vitalSigns()->latest()->first();
            }
        }
        

        return view('livewire.station.clinical-encounter');
    }

    public function mount()
    {
        
        
    }
    
    
}
