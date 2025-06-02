<?php

namespace App\Filament\Resources\FirebaseNotificationLogResource\Pages;

use App\Filament\Resources\FirebaseNotificationLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFirebaseNotificationLog extends EditRecord
{
    protected static string $resource = FirebaseNotificationLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
