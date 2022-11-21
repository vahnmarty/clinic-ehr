<?php

namespace App\Http\Livewire\Patient;

use Livewire\Component;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateParent extends Component implements HasForms
{
    use InteractsWithForms;

    public function render()
    {
        return view('livewire.patient.create-parent');
    }

    protected function getFormSchema(): array 
    {
        return [
            Fieldset::make('Demographic Information')
                ->columns(3)
                ->schema([
                    Select::make('parent_type')->options(['Father', 'Mother', 'Grandparent', 'Guardian'])->required(),
                    TextInput::make('first_name')->required(),
                    TextInput::make('last_name')->required(),
                    DatePicker::make('date_of_birth')->required(),
                    Select::make('primary_language')->options(['en' => 'English', 'es' => 'Spanish'])->required(),
                    Select::make('racial_identity')->options(['Native American'])->required(),
                    Select::make('marital_status')->options(['Single', 'Married'])->required(),
                    Select::make('primary_care_giver')->options(['Yes', 'No'])->required(),
                    Textarea::make('different_care_giver')->rows(2)->columnSpan('full')->label('If there is a different caregiver please provide their information'),
                ]),
            Fieldset::make('Contact Information')
                ->columns(3)
                ->schema([
                    TextInput::make('cellphone')->required(),
                    TextInput::make('whatsapp'),
                    TextInput::make('email')->email()->required(),
                    TextInput::make('address1')->email()->required(),
                    TextInput::make('country')->email()->required(),
                    TextInput::make('city')->email()->required(),
                    TextInput::make('state')->email()->required(),
                    TextInput::make('zip_code')->email()->required(),
                    TextInput::make('district')->email()->required(),
                    TextInput::make('dpi_number')->email()->required(),
                    Select::make('migrant')->options(['Yes', 'No'])->required(),
                ]),
        
        ];
    } 
}
