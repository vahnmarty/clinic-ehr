<?php

namespace App\Http\Livewire\Station;

use App\Models\Patient;
use Livewire\Component;
use App\Models\MedicalCode;
use App\Models\MedicalCoding;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Concerns\InteractsWithTable;

class AssessmentMedicalCoding extends Component implements HasTable
{
    use InteractsWithTable;
    
    public $patient_id;

    public function render()
    {
        return view('livewire.station.assessment-medical-coding');
    }

    public function mount($patientId)
    {
        $this->patient_id = $patientId;
    }

    protected function getTableQuery() 
    {
        return MedicalCoding::where('patient_id', $this->patient_id);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('index')->rowIndex()->label(''),
            TextColumn::make('medical_code'),
            TextColumn::make('code'),
            TextColumn::make('description'),
        ];
    }

    protected function getForm()
    {
        return [ 
            Grid::make(1)->schema([
                Select::make('medical_code_id')
                    ->label('Search')
                    ->searchable()
                    ->getSearchResultsUsing(fn (string $search) => MedicalCode::search($search)->limit(50)->get()->pluck('option_result', 'id')),
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
                    $medicalCode = MedicalCode::find($data['medical_code_id']);
                    $patient->medicalCodings()->create([
                        'medical_code_id' => $medicalCode->id,
                        'medical_code' => $medicalCode->code1,
                        'code' => $medicalCode->code3,
                        'description' => $medicalCode->description1
                    ]);
                    
                })
                ->button()
        ];
    }

    protected function getTableActions() : array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
