<?php

namespace App\Filament\Resources\FirebaseNotificationLogResource\Pages;

use App\Filament\Resources\FirebaseNotificationLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFirebaseNotificationLogs extends ListRecords
{
    protected static string $resource = FirebaseNotificationLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
