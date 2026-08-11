<?php

namespace App\Filament\Resources\ContactMessages\Pages;

use App\Filament\Resources\ContactMessages\ContactMessageResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;

class ViewContactMessage extends ViewRecord
{
    protected static string $resource = ContactMessageResource::class;

    /**
     * Tandai pesan sebagai sudah dibaca begitu dibuka.
     */
    public function mount(int|string $record): void
    {
        parent::mount($record);

        if (! $this->record->is_read) {
            $this->record->update(['is_read' => true]);
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('balasEmail')
                ->label('Balas via Email')
                ->icon('heroicon-o-envelope')
                ->color('gray')
                ->url(fn (): string => 'mailto:' . $this->record->email
                    . '?subject=' . rawurlencode('Re: ' . ($this->record->subject ?: 'Pesan dari website')))
                ->openUrlInNewTab(),
            Action::make('tandaiBelumDibaca')
                ->label('Tandai Belum Dibaca')
                ->icon('heroicon-o-envelope-open')
                ->color('warning')
                ->visible(fn (): bool => (bool) $this->record->is_read)
                ->action(function (): void {
                    $this->record->update(['is_read' => false]);
                    $this->redirect(ContactMessageResource::getUrl('index'));
                }),
            DeleteAction::make(),
        ];
    }
}
