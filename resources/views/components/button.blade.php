@props([
    'variant' => 'primary',
    'type' => 'button'
])

@php
    // Aturan Button dari contentful.com-DESIGN.md:
    // - Padding: 8px 16px (px-4 py-2)
    // - Radius: 4px (rounded-sm)
    // - Typography: Avenir Next, 14px size, weight 500 (text-sm font-medium)
    // - Touch target: min 44x44px (min-h-[44px])
    $baseClasses = 'inline-flex items-center justify-center font-medium transition-colors duration-150 rounded-sm text-sm focus:outline-none min-h-[44px] px-4 py-2 select-none';
    
    $variants = [
        'primary' => 'bg-brand-blue text-white hover:bg-brand-blueDark focus:ring-2 focus:ring-brand-blue/30',
        'secondary' => 'bg-surface border border-border-core text-text-primary hover:bg-bg-app focus:ring-2 focus:ring-brand-blue/10',
        'positive' => 'bg-[#17B897] text-white hover:bg-[#129378] focus:ring-2 focus:ring-brand-teal/30',
        'negative' => 'bg-[#D32F2F] text-white hover:bg-[#b72222] focus:ring-2 focus:ring-semantic-error/30',
    ];

    $variantClass = $variants[$variant] ?? $variants['primary'];
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => "$baseClasses $variantClass"]) }}>
    {{ $slot }}
</button>
