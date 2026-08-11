<?php

namespace App\Filament\Resources\GlossaryTerms\Pages;

use App\Filament\Resources\GlossaryTerms\GlossaryTermResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGlossaryTerm extends EditRecord
{
    protected static string $resource = GlossaryTermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
