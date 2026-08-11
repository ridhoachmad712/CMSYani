<?php

namespace App\Filament\Resources\GlossaryTerms;

use App\Filament\Resources\GlossaryTerms\Pages\CreateGlossaryTerm;
use App\Filament\Resources\GlossaryTerms\Pages\EditGlossaryTerm;
use App\Filament\Resources\GlossaryTerms\Pages\ListGlossaryTerms;
use App\Filament\Resources\GlossaryTerms\Schemas\GlossaryTermForm;
use App\Filament\Resources\GlossaryTerms\Tables\GlossaryTermsTable;
use App\Models\GlossaryTerm;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GlossaryTermResource extends Resource
{
    protected static ?string $model = GlossaryTerm::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static string|\UnitEnum|null $navigationGroup = 'Konten Edukasi';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationLabel = 'Glosarium';

    protected static ?string $modelLabel = 'Istilah Glosarium';

    protected static ?string $pluralModelLabel = 'Glosarium';

    public static function form(Schema $schema): Schema
    {
        return GlossaryTermForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GlossaryTermsTable::configure($table);
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
            'index' => ListGlossaryTerms::route('/'),
            'create' => CreateGlossaryTerm::route('/create'),
            'edit' => EditGlossaryTerm::route('/{record}/edit'),
        ];
    }
}
