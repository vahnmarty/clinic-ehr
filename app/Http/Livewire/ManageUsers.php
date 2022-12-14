<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\ComponentContainer;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ManageUsers extends Component implements HasTable
{
    use InteractsWithTable;
    use LivewireAlert;
    
    public function render()
    {
        return view('livewire.manage-users');
    }

    protected function getTableQuery() 
    {
        return User::withTrashed();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->sortable()->searchable(),
            TextColumn::make('name')->sortable()->searchable(),
            TextColumn::make('email')->sortable()->searchable(),
            TextColumn::make('roles.name')->sortable(),
            TextColumn::make('created_at'),
        ];
    }

    protected function getTableActions() : array
    {
        return [
            Action::make('edit')
                ->label('')
                ->modalHeading('Edit User')
                ->icon('heroicon-o-pencil')
                ->color('warning')
                ->mountUsing(function (ComponentContainer $form, User $record) {
                    $form->fill($record->toArray());
                })
                ->form([
                    Grid::make(2)
                    ->schema([
                        TextInput::make('name')->required(),
                        TextInput::make('email')->email()->required(),
                        Select::make('role')->options(Role::all()->pluck('name', 'id'))
                    ])
                ])
                ->action(function (User $record, array $data): void {
                    $record->update([
                        'name' => $data['name'],
                        'email' => $data['email']
                    ]);

                    $record->syncRoles( [$data['role']] ) ;

                    $this->alert('success', 'User updated successfully!');
                })
                ->hidden(fn (User $record): bool => $record->deleted_at ? true : false ),
            Action::make('password')
                ->label('')
                ->modalHeading('Change Password')
                ->icon('heroicon-o-key')
                ->form([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('password')->required(),
                        ])
                ])
                ->action(function (User $record, array $data): void {
                    $record->update($data);

                    $this->alert('success', 'Password updated successfully!');
                })
                ->hidden(fn (User $record): bool => $record->deleted_at ? true : false ),
            DeleteAction::make()->label(''),
            Action::make('recover')
                    ->visible(fn (User $record): bool => $record->deleted_at ? true : false )
                    ->action(function (User $record, array $data): void {
                        $record->deleted_at = null;
                        $record->save();
                        $this->alert('success', 'User recovered successfully!');
                    })
                    ->requiresConfirmation()
        ];
    }

    protected function getTableHeaderActions() : array
    {
        return [
            Action::make('create')
                ->label('Create User')
                ->icon('heroicon-o-plus')
                ->form([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('name')->required(),
                            TextInput::make('email')->email()->required(),
                            TextInput::make('password')->required(),
                            Select::make('role')->options(Role::all()->pluck('name', 'id'))
                        ])
                ])
                ->action(function (array $data): void {
                    $user = new User;
                    $user->name = $data['name'];
                    $user->email = $data['email'];
                    $user->password = bcrypt($data['password']);
                    $user->save();

                    $user->assignRole( $data['role'] ) ;

                    $this->alert('success', 'User created successfully!');
                    
                })
                ->button()
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            Filter::make('deleted')
                    ->query(fn (Builder $query): Builder => $query->withTrashed()->whereNotNull('deleted_at'))
        ];
    }
}
