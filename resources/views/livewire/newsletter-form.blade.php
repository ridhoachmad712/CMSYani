<div>
    @if ($subscribed)
        <p class="rounded-lg bg-white/10 px-4 py-3 text-sm text-cream">
            Terima kasih! Email Anda telah terdaftar untuk menerima info pajak terbaru.
        </p>
    @else
        <form wire:submit="subscribe" class="flex flex-col gap-2 sm:flex-row">
            <input type="email" wire:model="email" placeholder="Email Anda"
                   class="w-full rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm text-cream placeholder-cream/50 focus:border-gold focus:outline-none">
            <button type="submit" class="rounded-full bg-gold px-5 py-2 text-sm font-semibold text-navy transition hover:bg-gold/90"
                    wire:loading.attr="disabled" wire:target="subscribe">
                <span wire:loading.remove wire:target="subscribe">Langganan</span>
                <span wire:loading wire:target="subscribe">...</span>
            </button>
        </form>
        @error('email') <p class="mt-1 text-xs text-red-300">{{ $message }}</p> @enderror
    @endif
</div>
