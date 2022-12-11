<?php

namespace App\Http\Livewire\Station;

use App\Models\Patient;
use Livewire\Component;
use App\Models\PlanMedication;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Concerns\InteractsWithTable;

class EncounterMedication extends Component implements HasTable
{

    use InteractsWithTable;

    public $patient_id;

    public function render()
    {
        return view('livewire.station.encounter-medication');
    }

    public function mount($patientId)
    {
        $this->patient_id = $patientId;
    }

    protected function getTableQuery() 
    {
        return PlanMedication::where('patient_id', $this->patient_id);
    }

    protected function getForm()
    {
        return [ 
            Grid::make(3)->schema([
                TextInput::make('drug')->required(),
                TextInput::make('description')->required(),
                TextInput::make('dosage')->required(),
                TextInput::make('period')->required(),
                TextInput::make('dosage_form')->required(),
            ])
        ];
    }

    protected function getTableHeaderActions() : array
    {
        return [
            Action::make('create')
                ->label('Add Row')
                ->icon('heroicon-o-plus')
                ->form($this->getForm())
                ->action(function (array $data): void {
                    $patient = Patient::find($this->patient_id);
                    $patient->planMedications()->create($data);
                    
                })
                ->button()
        ];
    }
}
