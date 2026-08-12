<?php

namespace App\Filament\Pages;

use App\Models\SiteText;
use App\Support\SiteTexts;
use BackedEnum;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ManageTexts extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    protected string $view = 'filament.pages.manage-texts';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPencilSquare;

    protected static string|\UnitEnum|null $navigationGroup = 'Pengaturan';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Teks Halaman Depan';

    protected static ?string $title = 'Teks Halaman Depan';

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->can('View:ManageTexts') ?? false;
    }

    public function mount(): void
    {
        $this->form->fill(array_merge(SiteTexts::defaults(), SiteTexts::values()));
    }

    public function form(Schema $schema): Schema
    {
        $sections = [];

        foreach (SiteTexts::definition() as $group) {
            $fields = [];

            foreach ($group['fields'] as $key => $field) {
                $multiline = $field[2] ?? false;

                $component = $multiline
                    ? Textarea::make($key)->rows(2)
                    : TextInput::make($key);

                $fields[] = $component->label($field[0]);
            }

            $sections[] = Section::make($group['label'])
                ->schema($fields)
                ->collapsible();
        }

        return $schema->statePath('data')->components($sections);
    }

    public function save(): void
    {
        foreach ($this->form->getState() as $key => $value) {
            SiteText::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        SiteTexts::forget();

        Notification::make()->title('Teks halaman berhasil disimpan.')->success()->send();
    }
}
