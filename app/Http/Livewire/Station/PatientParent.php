<?php

namespace App\Http\Livewire\Station;

use App\Models\Patient;
use Livewire\Component;
use App\Models\Guardian;
use App\Enums\GuardianType;
use App\Enums\MaritalStatus;
use App\Enums\RacialIdentity;
use App\Enums\PrimaryLanguage;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PatientParent extends Component implements HasTable
{
    public $patient_id;

    use InteractsWithTable;
    
    public function render()
    {
        return view('livewire.station.patient-parent');
    }

    public function mount($patientId)
    {
        $this->patient_id = $patientId;
    }

    protected function getTableQuery(): Builder 
    {
        return Guardian::where('patient_id', $this->patient_id);
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
            TextColumn::make('parent_type')->enum(GuardianType::asSelectArray()),
            TextColumn::make('first_name'),
            TextColumn::make('last_name'),
        ];
    }

    protected function getForm()
    {
        return [ 
            Fieldset::make('Demographic Information')
            ->columns(3)
            ->schema([
                Select::make('parent_type')->options(GuardianType::asSelectArray())->required(),
                TextInput::make('first_name')->required(),
                TextInput::make('last_name')->required(),
                DatePicker::make('date_of_birth')->required(),
                Select::make('primary_language')->options(PrimaryLanguage::asSelectArray())->required(),
                Select::make('racial_identity')->options(RacialIdentity::asSelectArray())->required(),
                Select::make('marital_status')->options(MaritalStatus::asSelectArray())->required(),
                Select::make('is_primary_caregiver')->label('Primary Caregiver')->options([ 1 => 'Yes', 0 => 'No'])->required(),
                TextInput::make('different_caregiver')
                    ->columnSpan('full')
                    ->label('If there is a different caregiver please provide their information'),
            ]),
        Fieldset::make('Contact Information')
            ->columns(3)
            ->schema([
                TextInput::make('cellphone')->required(),
                TextInput::make('whatsapp')->nullable(),
                TextInput::make('email')->email()->nullable(),
                TextInput::make('address1')->required(),
                TextInput::make('country')->required(),
                TextInput::make('city')->required(),
                TextInput::make('state')->required(),
                TextInput::make('zip_code')->required(),
                TextInput::make('district')->nullable(),
                TextInput::make('dpi_number')->nullable(),
                Select::make('is_migrant')->label('Migrant')->options([ 1 => 'Yes', 0 => 'No'])->required(),
            ])
        ];
    }

    protected function getTableEmptyStateActions(): array
    {
        return [
            Action::make('create')
                ->label('Create Parent/Guardian')
                ->icon('heroicon-o-plus')
                ->form($this->getForm())
                ->action(function (array $data): void {
                    $patient = Patient::find($this->patient_id);
                    $patient->guardians()->create($data);
                    
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
                ->mountUsing(fn (ComponentContainer $form, Guardian $record) => $form->fill($record->toArray()))
                ->form($this->getForm())
                ->action(function (Guardian $record, array $data): void {
                    $record->update($data);
                }),
            DeleteAction::make(),
        ];
    }
}
