<?php

namespace App\Http\Livewire\Station;

use App\Models\Patient;
use Livewire\Component;
use App\Models\PlanLaboratory;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class LaboratoryOrders extends Component implements HasTable
{
    use InteractsWithTable;
    
    public $patient_id;

    public function render()
    {
        return view('livewire.station.laboratory-orders');
    }

    public function mount($patientId)
    {
        $this->patient_id = $patientId;
        $this->patient = Patient::find($patientId);
    }

    protected function getTableQuery() 
    {
        return PlanLaboratory::where('patient_id', $this->patient_id)->latest();
    }
}
