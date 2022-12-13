<?php

namespace App\Http\Livewire\Pharmacy;

use App\Models\Product;
use Livewire\Component;
use App\Enums\ProductType;
use App\Models\Laboratory;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\ComponentContainer;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Tables\Concerns\InteractsWithTable;

class ManageLaboratories extends Component implements HasTable
{
    use InteractsWithTable;
    use LivewireAlert;

    public $name, $description;
    
    public function render()
    {
        return view('livewire.pharmacy.manage-laboratories');
    }

    protected function getTableQuery() 
    {
        return Laboratory::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->sortable(),
            TextColumn::make('name')->sortable(),
            TextColumn::make('description')->sortable(),
        ];
    }

    protected function getForm()
    {
        return [
            Grid::make(3)->schema([
                TextInput::make('name')->required(),
                TextInput::make('description'),
            ]) 
        ];
    }

    protected function getTableHeaderActions() : array
    {
        return [
            Action::make('create')
                ->label('Add Item')
                ->icon('heroicon-o-plus')
                ->form($this->getForm())
                ->action(function (array $data): void {
                    Laboratory::create($data);
                    $this->alert('success', 'Laboratory Item added successfully!');
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
                ->mountUsing(fn (ComponentContainer $form, Laboratory $record) => $form->fill($record->toArray()))
                ->form($this->getForm())
                ->action(function (Laboratory $record, array $data): void {
                    $record->update($data);
                }),
            DeleteAction::make(),
        ];
    }
}
