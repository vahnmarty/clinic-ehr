<?php

namespace App\Http\Livewire\Patient;

use App\Models\Patient;
use Livewire\Component;
use App\Models\ClinicEncounter;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class PatientClinicalEncounter extends Component implements HasTable
{
    use InteractsWithTable;

    public Patient $patient;
    public $patient_id;

    public function render()
    {
        return view('livewire.patient.patient-clinical-encounter');
    }

    public function mount($patientId)
    {
        $this->patient_id = $patientId;
        $this->patient = Patient::find($patientId);
    }

    protected function getTableQuery() 
    {
        return ClinicEncounter::wherePatientId($this->patient_id);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->sortable()->searchable(),
            TextColumn::make('created_at')->date(),
            TextColumn::make('chief_complaint')->sortable()->searchable(),
            TextColumn::make('user.name'),
        ];
    }

    protected function getTableActions() : array
    {
        return [
            Action::make('view')
                ->label('View')
                ->icon('heroicon-o-eye')
                ->url(fn ($record): string => route('station.clinical-encounter.show', $record->id))
                ->button(),
        ];
    }
}
