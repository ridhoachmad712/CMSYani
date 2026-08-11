<?php

namespace App\Filament\Resources\TaxCalendarEvents\Pages;

use App\Filament\Resources\TaxCalendarEvents\TaxCalendarEventResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTaxCalendarEvent extends EditRecord
{
    protected static string $resource = TaxCalendarEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
