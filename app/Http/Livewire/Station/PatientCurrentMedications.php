<?php

namespace App\Http\Livewire\Station;

use App\Models\Patient;
use Livewire\Component;
use App\Models\Medication;
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

class PatientCurrentMedications extends Component implements HasTable
{
    use InteractsWithTable;

    public $patient_id;

    public $name, $supplements;
    
    public function render()
    {
        return view('livewire.station.patient-current-medications');
    }

    public function mount($patientId)
    {
        $this->patient_id = $patientId;
    }

    protected function getTableQuery(): Builder 
    {
        return Medication::where('patient_id', $this->patient_id);
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
            TextColumn::make('id')->rowIndex(),
            TextColumn::make('name'),
            TextColumn::make('supplements'),
        ];
    }

    protected function getForm()
    {
        return [ 
                TextInput::make('name')->required(),
                TextInput::make('supplements')
             ];
    }

    protected function getTableEmptyStateActions(): array
    {
        return [
            Action::make('create')
                ->label('Create Medication')
                ->icon('heroicon-o-plus')
                ->form($this->getForm())
                ->action(function (array $data): void {
                    $patient = Patient::find($this->patient_id);
                    $patient->medications()->create($data);
                    
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
                ->mountUsing(fn (ComponentContainer $form, Medication $record) => $form->fill($record->toArray()))
                ->form($this->getForm())
                ->action(function (Medication $record, array $data): void {
                    $record->update($data);
                }),
            DeleteAction::make(),
        ];
    }
}
