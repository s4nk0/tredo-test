<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FirebaseNotificationLogResource\Pages;
use App\Filament\Resources\FirebaseNotificationLogResource\RelationManagers;
use App\Models\FirebaseNotificationLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FirebaseNotificationLogResource extends Resource
{
    protected static ?string $model = FirebaseNotificationLog::class;


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                Tables\Columns\TextColumn::make('id'),
                IconColumn::make('sent')
                    ->boolean(),
                Tables\Columns\TextColumn::make('user.name')->label('user_name'),
                Tables\Columns\TextColumn::make('request_body.token')
                    ->label('device_id')
                    ->limit(50)
                    ->copyable()
                    ->copyMessageDuration(1500),
                Tables\Columns\TextColumn::make('request_body.title')->label('title'),
                Tables\Columns\TextColumn::make('request_body.body')
                    ->limit(50)
                    ->copyable()
                    ->copyMessageDuration(1500)
                    ->label('text'),
                Tables\Columns\TextColumn::make('created_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFirebaseNotificationLogs::route('/'),
//            'create' => Pages\CreateFirebaseNotificationLog::route('/create'),
//            'edit' => Pages\EditFirebaseNotificationLog::route('/{record}/edit'),
        ];
    }
}
