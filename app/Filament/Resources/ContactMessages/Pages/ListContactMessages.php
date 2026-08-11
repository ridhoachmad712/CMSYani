<?php

namespace App\Filament\Resources\ContactMessages\Pages;

use App\Filament\Resources\ContactMessages\ContactMessageResource;
use Filament\Resources\Pages\ListRecords;

class ListContactMessages extends ListRecords
{
    protected static string $resource = ContactMessageResource::class;

    // Pesan masuk dibuat dari form publik, bukan dari panel: tanpa tombol "Create".
    protected function getHeaderActions(): array
    {
        return [];
    }
}
