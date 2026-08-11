<div>
    @if ($sent)
        <div class="rounded-xl border border-green-200 bg-green-50 p-6 text-center">
            <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-green-100 text-green-600">
                <x-heroicon-o-check-circle class="h-7 w-7" />
            </div>
            <p class="font-semibold text-green-800">Terima kasih! Pesan Anda telah terkirim.</p>
            <p class="mt-1 text-sm text-green-700">Kami akan segera menghubungi Anda kembali.</p>
            <button type="button" wire:click="$set('sent', false)"
                    class="mt-4 text-sm font-medium text-navy underline hover:text-gold">
                Kirim pesan lain
            </button>
        </div>
    @else
        <form wire:submit="submit" class="space-y-4">
            {{-- Honeypot (disembunyikan dari manusia) --}}
            <div class="hidden" aria-hidden="true">
                <label>Website
                    <input type="text" wire:model="website" tabindex="-1" autocomplete="off">
                </label>
            </div>

            <div>
                <label for="cf-name" class="mb-1 block text-sm font-medium text-navy">Nama <span class="text-red-500">*</span></label>
                <input type="text" id="cf-name" wire:model="name"
                       class="w-full rounded-lg border border-navy/20 px-4 py-2.5 text-navy focus:border-gold focus:outline-none focus:ring-1 focus:ring-gold">
                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label for="cf-email" class="mb-1 block text-sm font-medium text-navy">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="cf-email" wire:model="email"
                           class="w-full rounded-lg border border-navy/20 px-4 py-2.5 text-navy focus:border-gold focus:outline-none focus:ring-1 focus:ring-gold">
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="cf-phone" class="mb-1 block text-sm font-medium text-navy">Telepon / WA</label>
                    <input type="text" id="cf-phone" wire:model="phone"
                           class="w-full rounded-lg border border-navy/20 px-4 py-2.5 text-navy focus:border-gold focus:outline-none focus:ring-1 focus:ring-gold">
                    @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="cf-subject" class="mb-1 block text-sm font-medium text-navy">Subjek</label>
                <input type="text" id="cf-subject" wire:model="subject" placeholder="mis. Konsultasi Pajak"
                       class="w-full rounded-lg border border-navy/20 px-4 py-2.5 text-navy focus:border-gold focus:outline-none focus:ring-1 focus:ring-gold">
                @error('subject') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="cf-message" class="mb-1 block text-sm font-medium text-navy">Pesan <span class="text-red-500">*</span></label>
                <textarea id="cf-message" wire:model="message" rows="4"
                          class="w-full rounded-lg border border-navy/20 px-4 py-2.5 text-navy focus:border-gold focus:outline-none focus:ring-1 focus:ring-gold"></textarea>
                @error('message') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <button type="submit"
                    class="w-full rounded-full bg-navy px-6 py-3 font-semibold text-cream transition hover:bg-navy-secondary disabled:opacity-60"
                    wire:loading.attr="disabled" wire:target="submit">
                <span wire:loading.remove wire:target="submit">Kirim Pesan</span>
                <span wire:loading wire:target="submit">Mengirim...</span>
            </button>
        </form>
    @endif
</div>
