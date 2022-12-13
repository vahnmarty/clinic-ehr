<?php

namespace App\Http\Livewire\Station;

use Closure;
use App\Models\Patient;
use App\Models\Product;
use Livewire\Component;
use App\Models\PlanMedication;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Concerns\InteractsWithTable;

class EncounterMedication extends Component implements HasTable
{

    use InteractsWithTable;

    public $patient_id, $product_id, $drug, $description, $dosage, $period, $dosage_form;

    public function render()
    {
        return view('livewire.station.encounter-medication');
    }

    public function mount($patientId)
    {
        $this->patient_id = $patientId;
    }

    protected function getTableQuery() 
    {
        return PlanMedication::where('patient_id', $this->patient_id);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('index')->rowIndex()->label(''),
            TextColumn::make('drug'),
            TextColumn::make('description')->label('Drug Name/Description'),
            TextColumn::make('period'),
        ];
    }

    protected function getForm()
    {
        return [ 
            Grid::make(3)->schema([
                Select::make('product_id')
                    ->label('Search')
                    ->searchable()
                    ->reactive()
                    ->getSearchResultsUsing(fn (string $search) => Product::search($search)->limit(50)->get()->pluck('name', 'id'))
                    ->afterStateUpdated(function (Closure $set, $state) {
                        $product = Product::find($state);
                        $set('drug', $product->name);
                    }),
                Hidden::make('drug'),
                TextInput::make('description')->disabled(),
                TextInput::make('dosage')->required(),
                TextInput::make('period')->required(),
                TextInput::make('dosage_form')->required(),
            ])
        ];
    }

    
    protected function getTableHeaderActions() : array
    {
        return [
            Action::make('create')
                ->label('Add Row')
                ->icon('heroicon-o-plus')
                ->form($this->getForm())
                ->action(function (array $data): void {
                    $patient = Patient::find($this->patient_id);
                    $product = Product::find($data['product_id']);
                    $patient->planMedications()->create($data);
                    
                })
                ->button()
        ];
    }
}
