<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient_id')->sortable(),
                Tables\Columns\TextColumn::make('first_name')->sortable(),
                Tables\Columns\TextColumn::make('last_name')->sortable(),
                Tables\Columns\TextColumn::make('date_of_birth')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()->label('Edit Patient Chart'),
                    Tables\Actions\Action::make('check-in')
                        ->label('Check In Patient')
                        ->action('checkInModal')
                        ->icon('heroicon-s-cog')
                        ->form([
                            Forms\Components\Select::make('authorId')
                                ->label('Author')
                                ->options([1, 2])
                                ->required(),
                        ])
                ])
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public function checkInModal(): void
    {
        $this->dispatchBrowserEvent('open-checkin-modal');
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
