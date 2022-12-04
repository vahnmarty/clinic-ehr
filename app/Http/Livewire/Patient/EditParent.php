<?php

namespace App\Http\Livewire\Patient;

use App\Models\Patient;
use Livewire\Component;
use App\Models\Guardian;
use App\Enums\GuardianType;
use App\Enums\MaritalStatus;
use App\Enums\RacialIdentity;
use App\Enums\PrimaryLanguage;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Forms\Concerns\InteractsWithForms;

class EditParent extends Component implements HasForms
{
    use InteractsWithForms;

    use LivewireAlert;

    public $guardian_id;

    public $parent_type, $first_name, $last_name, $date_of_birth, $primary_language, $racial_identity, $marital_status, $is_primary_caregiver, $different_caregiver;

    public $cellphone, $whatsapp, $email, $address1, $country, $city, $state, $zip_code, $district, $dpi_number, $is_migrant;

    public function render()
    {
        return view('livewire.patient.edit-parent');
    }

    public function mount($guardianId)
    {
        $this->guardian_id = $guardianId;
        $guardian = Guardian::find($guardianId);

        $this->form->fill($guardian->toArray());
    }

    protected function getFormSchema(): array 
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
                ]),
        
        ];
    }

    public function update()
    {
        $data = $this->validate();

        $guardian = Guardian::find($this->guardian_id);
        $guardian->fill($data);
        $guardian->save();

        $this->alert('success', "Patient's Guardian  updated successfuly.");

        $this->dispatchBrowserEvent('closemodal-show-parent-' . $this->guardian_id);

        $this->emitUp('refreshParent');
    }
}
