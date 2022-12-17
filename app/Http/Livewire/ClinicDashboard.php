<?php

namespace App\Http\Livewire;

use App\Models\Clinic;
use Livewire\Component;
use App\Models\Application;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Concerns\InteractsWithTable;

class ClinicDashboard extends Component implements HasTable
{   
    use InteractsWithTable;
    
    public Clinic $clinic;
    public $clinic_id;
    public $clinics = [];

    public function render()
    {
        return view('livewire.clinic-dashboard');
    }

    public function mount($clinicId)
    {
        $this->clinic_id = $clinicId;
        $this->clinic = Clinic::findOrFail($clinicId);
        $this->clinics = Clinic::get();
    }

    protected function getTableQuery() 
    {
        return Application::where('clinic_id', $this->clinic_id);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->rowIndex(),
            TextColumn::make('patient.patient_number')->label('Patient ID')->searchable(),
            TextColumn::make('patient.full_name')->label('Name')->sortable()->searchable(),
            TextColumn::make('visit_reason'),
            TextColumn::make('check_in_at')->label('Arrival Time')->dateTime()->sortable(),
            BadgeColumn::make('status')
                ->colors([
                    'success' => 'PHARMACY ORDER',
                    'primary' => 'PATIENT INFO',
                    'warning' => 'VITAL SIGN',
                    'secondary' => 'RESEARCH FORM',
                    'danger' => 'CLINIC ENCOUNTER'
                ])->sortable(),
            
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('view')
                ->url(fn (Application $record): string => route('patient.show', $record->patient_id))
                ->button(),
            ActionGroup::make([
                Action::make('edit')
                    ->label('Edit Patient Details')
                    ->url(fn (Application $record): string => route('patient.edit', $record->patient_id))
                    ->openUrlInNewTab(),
                Action::make('vital')
                    ->label('Vital Signs')
                    ->url(fn (Application $record): string => route('patient.vital-sign', $record->patient_id))
                    ->openUrlInNewTab(),
                Action::make('research')
                    ->label('Research Form')
                    ->url(fn (Application $record): string => route('station.research', $record->patient_id))
                    ->openUrlInNewTab(),
                Action::make('clinic')
                    ->label('Clinic Encounter')
                    ->url(fn (Application $record): string => route('station.clinical-encounter', $record->patient_id))
                    ->openUrlInNewTab(),
                Action::make('pharmacy')
                    ->label('Pharmacy Order')
                    ->url(fn (Application $record): string => route('station.pharmacy-order', $record->patient_id))
                    ->openUrlInNewTab(),
            ]),
        ];
    }
}
