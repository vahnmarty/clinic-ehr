<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\ComponentContainer;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Tables\Concerns\InteractsWithTable;

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
        return User::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id'),
            TextColumn::make('name'),
            TextColumn::make('email'),
            TextColumn::make('roles.name'),
            TextColumn::make('created_at'),
        ];
    }

    protected function getTableActions() : array
    {
        return [
            Action::make('edit')
                ->label('Edit')
                ->icon('heroicon-o-pencil')
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
                }),
            Action::make('password')
                ->label('Password')
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
                }),
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
}
