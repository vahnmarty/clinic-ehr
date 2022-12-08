<?php

namespace App\Http\Livewire\Station;

use App\Models\Patient;
use Livewire\Component;
use App\Models\MedicalProblem;
use Filament\Tables\Actions\Action;
use Filament\Forms\ComponentContainer;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PatientMedicalProblems extends Component implements HasTable
{
    use InteractsWithTable;

    public $patient_id;
    
    public function render()
    {
        return view('livewire.station.patient-medical-problems');
    }

    public function mount($patientId)
    {
        $this->patient_id = $patientId;
    }

    protected function getTableQuery(): Builder 
    {
        return MedicalProblem::where('patient_id', $this->patient_id);
    }

    protected function getTableHeaderActions() : array
    {
        return [
            CreateAction::make()
        ];
    }
    
    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
        ];
    }

    protected function getForm()
    {
        return [ TextInput::make('name')->required() ];
    }

    protected function getTableEmptyStateActions(): array
    {
        return [
            Action::make('create')
                ->label('Create Medical Problem')
                ->icon('heroicon-o-plus')
                ->form($this->getForm())
                ->action(function (array $data): void {
                    $patient = Patient::find($this->patient_id);
                    $patient->medicalProblems()->create($data);
                    
                })
                ->button()
        ];
    }

    protected function getTableActions() : array
    {
        return [
            Action::make('edit')
                ->label('Edit')
                ->icon('heroicon-o-pencil')
                ->mountUsing(fn (ComponentContainer $form, MedicalProblem $record) => $form->fill($record->toArray()))
                ->form($this->getForm())
                ->action(function (MedicalProblem $record, array $data): void {
                    $record->update($data);
                }),
            DeleteAction::make(),
        ];
    }
}
