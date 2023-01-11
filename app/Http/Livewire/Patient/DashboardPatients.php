<?php

namespace App\Http\Livewire\Patient;

use App\Models\Clinic;
use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Tables\Concerns\InteractsWithTable;

class DashboardPatients extends Component implements HasTable
{
    use InteractsWithTable;

    use LivewireAlert;

    protected $listeners = [ 'refreshParent' => '$refresh', 'confirmDelete' => 'destroy' ];

    public $clinics = [];

    public $delete_patient_id;
 
    public function render()
    {
        return view('livewire.patient.dashboard-patients');
    }

    public function mount()
    {
        $this->clinics = Clinic::get();
    }

    protected function getTableQuery() 
    {
        return Patient::withApplication();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->rowIndex(),
            TextColumn::make('patient_number')->label('Patient ID')->searchable(),
            TextColumn::make('first_name')->sortable()->searchable(),
            TextColumn::make('last_name')->sortable()->searchable(),
            TextColumn::make('date_of_birth'),
            TextColumn::make('latestApp.visit_reason')->label('Visit Reason'),
            TextColumn::make('latestApp.doctor.name')->label('Doctor'),
            BadgeColumn::make('latestApp.status')
                ->label('Status')
                ->colors([
                    'success' => 'PHARMACY ORDER',
                    'primary' => 'PATIENT INFO',
                    'warning' => 'VITAL SIGN',
                    'secondary' => 'RESEARCH FORM',
                    'danger' => 'CLINIC ENCOUNTER'
                ]),
            
        ];
    }

    public function checkInPatient($patient_id)
    {
        $this->emit('selectCheckIn', $patient_id);
    }

    public function destroy()
    {
        Patient::destroy($this->delete_patient_id);

        $this->reset('delete_patient_id');

        $this->alert('success', 'Patient removed successfully!');
    }

    public function deletePatient($patientId)
    {
        $this->delete_patient_id = $patientId;

        $this->alert('question', 'Are you sure you want to delete this patient?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, confirm delete',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('view')
                ->url(fn (Patient $record): string => route('patient.show', $record->id))
                ->button(),
            ActionGroup::make([
                Action::make('check_in')->url(fn (Patient $record): string => route('station.checkin', ['patient_id' => $record->id])),
            ]),
        ];
    }

    protected function getTableHeaderActions() : array
    {
        return [
            Action::make('create_patient')->url( route('station.checkin') )->button()
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('clinic_id')->options(Clinic::pluck('name','id'))
        ];
    }
    
}
