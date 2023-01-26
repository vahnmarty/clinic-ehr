<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Enums\OrderStatus;
use App\Models\PlanMedication;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Concerns\InteractsWithTable;

class ManagePharmacy extends Component implements HasTable
{
    use InteractsWithTable;
    
    public function render()
    {
        return view('livewire.manage-pharmacy');
    }

    protected function getTableQuery() 
    {
        return PlanMedication::latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('order_number')->label('Order #'),
            TextColumn::make('patient.patient_number')->label('Patient'),
            TextColumn::make('drug'),
            TextColumn::make('dosage'),
            BadgeColumn::make('order_status')
                ->enum(OrderStatus::asSelectArray())
                ->colors([
                    'primary',
                    'secondary' => 0,
                    'warning' => 1,
                    'success' => 2,
                    'danger' => 'rejected',
                ]),
            TextColumn::make('created_at'),
        ];
    }
}
