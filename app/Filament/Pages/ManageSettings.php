<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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
                        ColorPicker::make('hero_bg_color')
                            ->label('Warna Latar Hero')
                            ->helperText('Kosongkan untuk memakai warna navy default. Pilih warna gelap agar teks tetap terbaca.'),
                        FileUpload::make('hero_bg_image')
                            ->label('Gambar Latar Hero (opsional)')
                            ->image()
                            ->disk('public')
                            ->directory('hero')
                            ->visibility('public')
                            ->maxSize(4096)
                            ->fetchFileInformation(false)
                            ->helperText('Jika diisi, tampil sebagai latar hero dengan lapisan gelap agar teks terbaca.'),
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
                Section::make('Logo & Foto')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('logo_path')
                            ->label('Logo Kantor')
                            ->image()
                            ->disk('public')
                            ->directory('logo')
                            ->visibility('public')
                            ->imageEditor()
                            ->maxSize(2048)
                            ->fetchFileInformation(false)
                            ->helperText('Upload logo resmi kantor. Jika belum diupload, sistem menampilkan placeholder sementara.'),
                        FileUpload::make('profile_photo')
                            ->label('Foto Profil / Potret')
                            ->image()
                            ->disk('public')
                            ->directory('profile')
                            ->visibility('public')
                            ->imageEditor()
                            ->maxSize(3072)
                            ->columnSpanFull()
                            ->fetchFileInformation(false)
                            ->helperText('Tampil penuh di bagian Hero & Tentang Kami. Disarankan foto dengan latar transparan (PNG).'),
                        TextInput::make('profile_photo_size')
                            ->label('Ukuran Foto di Hero (px)')
                            ->numeric()
                            ->minValue(120)
                            ->maxValue(1000)
                            ->suffix('px')
                            ->placeholder('Otomatis')
                            ->helperText('Tinggi maksimum foto dalam pixel. Kosongkan untuk ukuran otomatis (menyesuaikan tinggi hero).'),
                        Select::make('profile_photo_position')
                            ->label('Posisi Foto di Hero')
                            ->options([
                                'kiri' => 'Kiri',
                                'tengah' => 'Tengah',
                                'kanan' => 'Kanan (default)',
                            ])
                            ->native(false)
                            ->placeholder('Kanan (default)'),
                        TextInput::make('logo_height')
                            ->label('Tinggi Logo di Navbar (px)')
                            ->numeric()
                            ->minValue(24)
                            ->maxValue(120)
                            ->placeholder('44')
                            ->helperText('Kosongkan untuk ukuran default (44px).'),
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
