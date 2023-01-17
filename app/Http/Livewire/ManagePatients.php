<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Clinic;
use App\Models\Patient;
use Livewire\Component;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\ComponentContainer;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Concerns\InteractsWithTable;

class ManagePatients extends Component implements HasTable
{
    use InteractsWithTable;
    
    public function render()
    {
        return view('livewire.manage-patients');
    }

    protected function getTableQuery() 
    {
        return Patient::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->sortable(),
            TextColumn::make('patient_number')->label('Patient ID')->searchable()->sortable(),
            TextColumn::make('first_name')->sortable()->searchable()->label('First Name'),
            TextColumn::make('last_name')->sortable()->searchable()->label('Last Name'),
            TextColumn::make('date_of_birth'),
            TextColumn::make('latestApp.check_in_at')->label('Last checked in')->dateTime('F d'),
            
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('update_check_in')
                ->label('Update')
                ->icon('heroicon-s-pencil')
                ->color('warning')
                ->form([
                    Select::make('clinic_id')->label('Clinic')->options(Clinic::all()->pluck('name', 'id'))->required(),
                    TextInput::make('visit_reason')->label('Visit Reason')->required(),
                    Select::make('doctor_id')->label('Doctor')->options(User::role('provider')->get()->pluck('name', 'id'))->required(),
                    DateTimePicker::make('appointment_date')
                    ->default(date('Y-m-d'))
                    ->minDate(now())
                ])
                ->mountUsing(fn (ComponentContainer $form, Patient $record) => $form->fill([
                    'clinic_id' => $record->latestApp->clinic_id,
                    'visit_reason' => $record->latestApp->visit_reason,
                    'doctor_id' => $record->latestApp->doctor_id,
                    'appointment_date' => $record->latestApp->appointment_date,
                ]))
                ->action(function (Patient $record, array $data) {
                    $record->update($data);
                })
                ->visible(fn(Patient $record) => $record->latestApp ? true : false),
            Action::make('check_in')
                ->url(fn (Patient $record): string => route('station.checkin', ['patient_id' => $record->id]))
                ->visible(fn(Patient $record) => $record->latestApp ? false : true),
            Action::make('patient_chart')
                ->url(fn (Patient $record): string => route('patient.show', $record->id))
                ->button(),
        ];
    }
}
