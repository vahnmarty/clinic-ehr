<?php

namespace App\Http\Livewire\Pharmacy;

use App\Models\Product;
use Livewire\Component;
use App\Enums\ProductType;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Tables\Concerns\InteractsWithTable;

class ManageProducts extends Component implements HasTable
{
    use InteractsWithTable;
    use LivewireAlert;

    public $name, $description, $stock_onhand, $unit, $type;
    
    public function render()
    {
        return view('livewire.pharmacy.manage-products');
    }

    protected function getTableQuery() 
    {
        return Product::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->sortable(),
            TextColumn::make('name')->sortable(),
            TextColumn::make('stock_onhand')->label('Quantity')->sortable(),
            TextColumn::make('unit'),
            TextColumn::make('type')->formatStateUsing(fn (string $state): string => ProductType::fromValue((int)$state)->key)->sortable(),
        ];
    }

    protected function getForm()
    {
        return [
            Grid::make(3)->schema([
                TextInput::make('name')->required(),
                TextInput::make('description'),
                TextInput::make('stock_onhand')->label('Quantity')->required(),
                TextInput::make('unit'),
                Select::make('type')->options(ProductType::asSelectArray()),
            ]) 
        ];
    }

    protected function getTableHeaderActions() : array
    {
        return [
            Action::make('create')
                ->label('Add Product')
                ->icon('heroicon-o-plus')
                ->form($this->getForm())
                ->action(function (array $data): void {
                    Product::create($data);
                    $this->alert('success', 'Product added successfully!');
                })
                ->button()
        ];
    }
}
