<?php

namespace App\Filament\Resources\TaxCalendarEvents;

use App\Filament\Resources\TaxCalendarEvents\Pages\CreateTaxCalendarEvent;
use App\Filament\Resources\TaxCalendarEvents\Pages\EditTaxCalendarEvent;
use App\Filament\Resources\TaxCalendarEvents\Pages\ListTaxCalendarEvents;
use App\Filament\Resources\TaxCalendarEvents\Schemas\TaxCalendarEventForm;
use App\Filament\Resources\TaxCalendarEvents\Tables\TaxCalendarEventsTable;
use App\Models\TaxCalendarEvent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TaxCalendarEventResource extends Resource
{
    protected static ?string $model = TaxCalendarEvent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static string|\UnitEnum|null $navigationGroup = 'Konten Edukasi';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationLabel = 'Kalender Pajak';

    protected static ?string $modelLabel = 'Kalender Pajak';

    protected static ?string $pluralModelLabel = 'Kalender Pajak';

    public static function form(Schema $schema): Schema
    {
        return TaxCalendarEventForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TaxCalendarEventsTable::configure($table);
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
            'index' => ListTaxCalendarEvents::route('/'),
            'create' => CreateTaxCalendarEvent::route('/create'),
            'edit' => EditTaxCalendarEvent::route('/{record}/edit'),
        ];
    }
}
