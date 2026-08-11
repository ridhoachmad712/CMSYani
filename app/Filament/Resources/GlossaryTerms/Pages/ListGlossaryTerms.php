<?php

namespace App\Filament\Resources\GlossaryTerms\Pages;

use App\Filament\Resources\GlossaryTerms\GlossaryTermResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGlossaryTerms extends ListRecords
{
    protected static string $resource = GlossaryTermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
