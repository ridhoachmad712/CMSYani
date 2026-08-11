@props([
    'eyebrow' => null,
    'title',
    'subtitle' => null,
    'align' => 'center',
    'light' => false,
])

@php
    $alignClass = $align === 'center' ? 'mx-auto text-center items-center' : 'text-left items-start';
    $titleColor = $light ? 'text-cream' : 'text-navy';
    $subColor = $light ? 'text-cream/75' : 'text-navy/70';
    $eyebrowColor = $light ? 'text-gold' : 'text-gold-dark';
@endphp

<div {{ $attributes->merge(['class' => "flex max-w-2xl flex-col $alignClass"]) }}>
    @if ($eyebrow)
        <span class="mb-2 text-sm font-semibold uppercase tracking-widest {{ $eyebrowColor }}">{{ $eyebrow }}</span>
    @endif
    <h2 class="text-3xl font-bold sm:text-4xl {{ $titleColor }}">{{ $title }}</h2>
    <div class="mt-3 h-1 w-20 rounded bg-gold {{ $align === 'center' ? 'mx-auto' : '' }}"></div>
    @if ($subtitle)
        <p class="mt-4 {{ $subColor }}">{{ $subtitle }}</p>
    @endif
</div>
