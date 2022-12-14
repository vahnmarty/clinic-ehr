<?php

namespace App\Http\Livewire\Station;

use Closure;
use App\Models\Patient;
use App\Models\Product;
use Livewire\Component;
use App\Models\Laboratory;
use App\Models\PlanLaboratory;
use App\Models\PlanMedication;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Concerns\InteractsWithTable;

class EncounterLaboratory extends Component implements HasTable
{

    use InteractsWithTable;

    public $patient_id, $product_id, $drug, $description, $dosage, $period, $dosage_form;

    public function render()
    {
        return view('livewire.station.encounter-laboratory');
    }

    public function mount($patientId)
    {
        $this->patient_id = $patientId;
    }

    protected function getTableQuery() 
    {
        return PlanLaboratory::where('patient_id', $this->patient_id)->whereNull('clinic_encounter_id');;
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('index')->rowIndex()->label(''),
            TextColumn::make('laboratory'),
            TextColumn::make('user.name')->label('Provider'), 
            TextColumn::make('created_at'),
        ];
    }

    protected function getForm()
    {
        return [ 
            Grid::make(3)->schema([
                Select::make('laboratory_id')
                    ->label('Select Request')
                    ->options(Laboratory::orderBy('name')->get()->pluck('name', 'id')),
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
                    $lab = Laboratory::find($data['laboratory_id']);
                    $patient->planLaboratories()->create([
                        'user_id' => auth()->id(),
                        'laboratory_id' => $data['laboratory_id'],
                        'laboratory' => $data['laboratory']
                    ]);
                    
                })
                ->button(),
        ];
    }

    protected function getTableActions() : array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
