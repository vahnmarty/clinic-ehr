<?php

namespace App\Http\Livewire\Patient;

use App\Models\Patient;
use App\Models\Vaccine;
use Livewire\Component;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\ComponentContainer;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Concerns\InteractsWithTable;

class VaccineRecords extends Component implements HasTable
{
    use InteractsWithTable;

    public $patient_id;

    public $name, $date_administered, $injection_sight, $lot_number;
    
    public function render()
    {
        return view('livewire.patient.vaccine-records');
    }

    public function mount($patientId)
    {
        $this->patient_id =  $patientId;
    }

    protected function getTableQuery(): Builder 
    {
        return Vaccine::where('patient_id', $this->patient_id);
    } 

    protected function getFormSchema(): array
    {
        return [
            Grid::make(2)->schema([
                Hidden::make('patient_id')->required(),
                TextInput::make('name')->required(),
                DatePicker::make('date_administered')->required(),
                TextInput::make('injection_sight')->nullable(),
                TextInput::make('lot_number')->nullable(),
            ])
        ];
    }

    protected function getTableHeaderActions() : array
    {
        return [
            CreateAction::make()
        ];
    }

    protected function getTableActions() : array
    {
        return [
            Action::make('edit')
                ->label('Edit')
                ->icon('heroicon-o-pencil')
                ->mountUsing(fn (ComponentContainer $form, Vaccine $record) => $form->fill([
                    'name' => $record->name,
                    'date_administered' => $record->date_administered,
                    'injection_sight' => $record->injection_sight,
                    'lot_number' => $record->lot_number,
                ]))
                ->form([
                    Grid::make(2)->schema([
                        TextInput::make('name')->required(),
                        DatePicker::make('date_administered')->required(),
                        TextInput::make('injection_sight')->nullable(),
                        TextInput::make('lot_number')->nullable(),
                    ])
                ])
                ->action(function (Vaccine $record, array $data): void {
                    $record->update($data);
                }),
            DeleteAction::make(),
        ];
    }

    protected function getTableEmptyStateActions(): array
    {
        return [
            Action::make('create')
                ->label('Create Vaccine')
                ->icon('heroicon-o-plus')
                ->form([
                    Grid::make(2)->schema([
                        TextInput::make('name')->required(),
                        DatePicker::make('date_administered')->required(),
                        TextInput::make('injection_sight')->nullable(),
                        TextInput::make('lot_number')->nullable(),
                    ])
                ])
                ->action(function (array $data): void {
                    $patient = Patient::find($this->patient_id);
                    $patient->vaccines()->create($data);
                    
                })
                ->button()
        ];
    } 

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name'),
            TextColumn::make('date_administered'),
            TextColumn::make('injection_sight'),
            TextColumn::make('lot_number'),
        ];
    }
}
