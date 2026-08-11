<x-layouts.app>
    <x-sections.hero :settings="$settings" :licenses="$licenses" />
    <x-sections.services :services="$services" />
    <x-sections.licenses :licenses="$licenses" />
    <x-sections.about :settings="$settings" />
    <x-sections.values />
    <x-sections.testimonials :testimonials="$testimonials" />
    <x-sections.latest-articles :articles="$latestArticles" />
    <x-sections.contact :settings="$settings" />
</x-layouts.app>
