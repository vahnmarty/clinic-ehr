<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\VaccineList;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\ComponentContainer;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Tables\Concerns\InteractsWithTable;

class ManageVaccines extends Component implements HasTable
{
    use InteractsWithTable;
    use LivewireAlert;
    
    public function render()
    {
        return view('livewire.manage-vaccines');
    }

    protected function getTableQuery() 
    {
        return VaccineList::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->sortable()->searchable(),
            TextColumn::make('name')->sortable()->searchable(),
            TextColumn::make('created_at'),
        ];
    }

    protected function getTableActions() : array
    {
        return [
            Action::make('edit')
                ->label('')
                ->modalHeading('Edit Vaccine')
                ->icon('heroicon-o-pencil')
                ->color('warning')
                ->mountUsing(function (ComponentContainer $form, VaccineList $record) {
                    $form->fill($record->toArray());
                })
                ->form([
                    Grid::make(2)
                    ->schema([
                        TextInput::make('name')->required(),
                    ])
                ])
                ->action(function (VaccineList $record, array $data): void {
                    $record->update([
                        'name' => $data['name'],
                    ]);

                    $this->alert('success', 'Vaccine updated successfully!');
                }),
            DeleteAction::make()->label(''),
        ];
    }

    protected function getTableHeaderActions() : array
    {
        return [
            Action::make('create')
                ->label('Create Vaccine')
                ->icon('heroicon-o-plus')
                ->form([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('name')->required(),
                        ])
                ])
                ->action(function (array $data): void {
                    $user = new VaccineList;
                    $user->name = $data['name'];
                    $user->save();


                    $this->alert('success', 'Vaccine created');
                    
                })
                ->button()
        ];
    }
}
