@props(['message' => 'Konten belum tersedia.'])

<div class="rounded-2xl border border-dashed border-navy/20 bg-white/60 px-6 py-16 text-center">
    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-navy/5 text-navy/40">
        <x-heroicon-o-document-magnifying-glass class="h-7 w-7" />
    </div>
    <p class="text-navy/70">{{ $message }}</p>
</div>
