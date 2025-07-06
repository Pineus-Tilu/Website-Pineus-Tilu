<?php

namespace App\Filament\Resources\GaleriResource\Pages;

use App\Filament\Resources\GaleriResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateGaleri extends CreateRecord
{
    protected static string $resource = GaleriResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Galeri berhasil ditambahkan')
            ->body('Gambar telah berhasil ditambahkan ke galeri.');
    }
}