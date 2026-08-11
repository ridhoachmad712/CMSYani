@props([
    'variant' => 'primary',
    'href' => null,
])

@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-full px-6 py-2.5 text-sm font-semibold transition focus:outline-none focus-visible:ring-2 focus-visible:ring-gold focus-visible:ring-offset-2';

    $variants = [
        // Emas solid, untuk CTA utama (di latar apa pun)
        'primary' => 'bg-gold text-navy shadow hover:bg-gold/90 focus-visible:ring-offset-navy',
        // Garis terang, untuk latar gelap/navy
        'outline-light' => 'border border-cream/30 text-cream hover:border-gold hover:text-gold focus-visible:ring-offset-navy',
        // Garis gelap, untuk latar terang/cream
        'outline-dark' => 'border border-navy/25 text-navy hover:border-gold hover:text-gold-dark',
        // Navy solid, untuk latar terang
        'navy' => 'bg-navy text-cream shadow hover:bg-navy-secondary',
    ];

    $classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button {{ $attributes->merge(['class' => $classes, 'type' => 'button']) }}>{{ $slot }}</button>
@endif
