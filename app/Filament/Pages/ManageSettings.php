<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ManageSettings extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    protected string $view = 'filament.pages.manage-settings';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|\UnitEnum|null $navigationGroup = 'Pengaturan';

    protected static ?string $navigationLabel = 'Pengaturan Situs';

    protected static ?string $title = 'Pengaturan Situs';

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    /**
     * Gerbang akses halaman: hanya user dengan permission View:ManageSettings
     * (superadmin & admin, bukan editor). Selaras dgn permission Shield.
     */
    public static function canAccess(): bool
    {
        return auth()->user()?->can('View:ManageSettings') ?? false;
    }

    public function mount(): void
    {
        $this->form->fill(SiteSetting::current()->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('Identitas & Hero')
                    ->columns(2)
                    ->schema([
                        TextInput::make('tagline')
                            ->label('Tagline')
                            ->maxLength(255),
                        Textarea::make('hero_subtitle')
                            ->label('Sub-judul Hero')
                            ->rows(2)
                            ->columnSpanFull(),
                    ]),
                Section::make('Tentang & Nilai')
                    ->schema([
                        Textarea::make('about_text')
                            ->label('Paragraf Tentang Kami')
                            ->rows(5)
                            ->columnSpanFull(),
                        Textarea::make('quote_text')
                            ->label('Kutipan Nilai')
                            ->rows(2)
                            ->columnSpanFull(),
                    ]),
                Section::make('Kontak')
                    ->columns(2)
                    ->schema([
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('phone_primary')
                            ->label('Telepon Utama')
                            ->tel()
                            ->maxLength(50),
                        TextInput::make('phone_secondary')
                            ->label('Telepon Sekunder')
                            ->tel()
                            ->maxLength(50),
                        TextInput::make('whatsapp_number')
                            ->label('Nomor WhatsApp (format wa.me)')
                            ->helperText('Format internasional tanpa tanda +, mis. 6285342241563.')
                            ->maxLength(30),
                        Textarea::make('address')
                            ->label('Alamat')
                            ->rows(2)
                            ->columnSpanFull(),
                        TextInput::make('instagram_url')
                            ->label('URL Instagram')
                            ->url()
                            ->prefixIcon('heroicon-o-link')
                            ->placeholder('https://instagram.com/...')
                            ->columnSpanFull(),
                    ]),
                Section::make('Logo')
                    ->schema([
                        FileUpload::make('logo_path')
                            ->label('Logo Kantor')
                            ->image()
                            ->disk('public')
                            ->directory('logo')
                            ->visibility('public')
                            ->imageEditor()
                            ->maxSize(2048)
                            ->helperText('Upload logo resmi kantor. Jika belum diupload, sistem menampilkan placeholder sementara.'),
                    ]),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        SiteSetting::current()->update($data);

        Notification::make()
            ->title('Pengaturan situs berhasil disimpan.')
            ->success()
            ->send();
    }
}
