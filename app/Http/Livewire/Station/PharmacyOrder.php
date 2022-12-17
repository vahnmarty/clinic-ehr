<?php

namespace App\Http\Livewire\Station;

use Livewire\Component;
use App\Enums\OrderStatus;
use App\Models\Application;
use App\Models\PlanMedication;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\ComponentContainer;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Tables\Concerns\InteractsWithTable;
use App\Http\Livewire\Station\SearchPatientTrait;

class PharmacyOrder extends Component implements HasTable
{
    use InteractsWithTable;
    use SearchPatientTrait;
    use LivewireAlert;

    protected $listeners = ['selectPatient'];
    
    public function render()
    {
        return view('livewire.station.pharmacy-order');
    }

    public function mount($patientId = null)
    {
        if($patientId){
            $this->selectPatient($patientId);
        }
    }

    protected function getTableQuery() 
    {
        return PlanMedication::where('patient_id', $this->patient_id)->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('order_number')->label('Order #'),
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

    protected function getTableActions() : array
    {
        return [
            Action::make('edit')
                ->label('Edit')
                ->icon('heroicon-o-pencil')
                ->mountUsing(fn (ComponentContainer $form, PlanMedication $record) => $form->fill($record->toArray()))
                ->form([
                    Select::make('order_status')->options(OrderStatus::asSelectArray())->required(),
                ])
                ->action(function (PlanMedication $record, array $data): void {
                    $record->update($data);

                    if($record->order_status == OrderStatus::COMPLETED){

                        $app = Application::wherePatientId($this->patient_id)->latest()->first();
                        $app->pharmacy_order_finished_at = now();
                        $app->pharmacy_order_user_id = auth()->id();
                        $app->save();
                        
                        $this->alert('success', 'Order successfully completed!');
                    }
                }),
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [];
        // return [
        //     BulkAction::make('delete')->action(fn (Collection $records) => $records->each->delete())
        // ];
    }
}
