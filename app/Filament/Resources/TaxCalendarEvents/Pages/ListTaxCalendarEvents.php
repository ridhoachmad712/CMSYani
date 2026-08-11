<?php

namespace App\Filament\Resources\TaxCalendarEvents\Pages;

use App\Filament\Resources\TaxCalendarEvents\TaxCalendarEventResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTaxCalendarEvents extends ListRecords
{
    protected static string $resource = TaxCalendarEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
