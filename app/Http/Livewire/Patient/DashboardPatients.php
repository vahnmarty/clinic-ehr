<?php

namespace App\Http\Livewire\Patient;

use App\Models\User;
use App\Models\Clinic;
use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\ComponentContainer;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Tables\Concerns\InteractsWithTable;
use App\Models\Application;

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
        return Application::today();
    }

    protected function getTableHeading()
    {
        return 'Dashboard Patients';
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->rowIndex(),
            TextColumn::make('patient.patient_number')->label('Patient ID')->searchable(),
            TextColumn::make('patient.first_name')->sortable()->searchable()->label('First Name'),
            TextColumn::make('patient.last_name')->sortable()->searchable()->label('Last Name'),
            TextColumn::make('visit_reason')->label('Visit Reason'),
            TextColumn::make('doctor.name')->label('Doctor'),
            BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'success' => 'PHARMACY ORDER',
                    'primary' => 'PATIENT INFO',
                    'warning' => 'VITAL SIGN',
                    'secondary' => 'RESEARCH FORM',
                    'danger' => 'CLINIC ENCOUNTER',
                    'success' => 'CHECKED IN'
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
            ActionGroup::make([
                Action::make('update_check_in')
                    ->form([
                        Select::make('clinic_id')->label('Clinic')->options(Clinic::all()->pluck('name', 'id'))->required(),
                        TextInput::make('visit_reason')->label('Visit Reason')->required(),
                        Select::make('doctor_id')->label('Doctor')->options(User::role('provider')->get()->pluck('name', 'id'))->required(),
                        DateTimePicker::make('appointment_date')
                        ->default(date('Y-m-d'))
                        ->minDate(now())
                    ])
                    ->mountUsing(fn (ComponentContainer $form, Application $record) => $form->fill([
                        'clinic_id' => $record->clinic_id,
                        'visit_reason' => $record->visit_reason,
                        'doctor_id' => $record->doctor_id,
                        'appointment_date' => $record->appointment_date,
                    ]))
                    ->action(function (Application $record, array $data) {
                        $record->update($data);
                    })
                    ->visible(true),
                Action::make('vital_sign')->url(fn(Application $record) => route('station.vital-sign', ['patientId' => $record->patient_id])),
                Action::make('research')->url(fn(Application $record) => route('station.research', ['patientId' => $record->patient_id])),
                Action::make('clinical_encounter')->url(fn(Application $record) => route('station.clinical-encounter', ['patientId' => $record->patient_id])),
                Action::make('pharmacy_order')->url(fn(Application $record) => route('station.pharmacy-order', ['patientId' => $record->patient_id])),
            ]),
            Action::make('patient_chart')
                ->url(fn (Application $record): string => route('patient.show', $record->patient_id))
                ->button(),
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
