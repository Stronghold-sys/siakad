@props([
    'disabled' => false
])

<!-- 
  Aturan Input dari contentful.com-DESIGN.md:
  - Border: 1px solid #CFD9E0 (border-border-core)
  - Radius: 4px (rounded-sm)
  - Padding: 8px 12px (px-3 py-2)
  - Focus: border #0286C3 (brand-blue), shadow 0 0 0 3px rgba(2,134,195,0.2)
  - Touch target: min 44x44px (min-h-[44px])
-->
<input {{ $disabled ? 'disabled' : '' }} 
       {{ $attributes->merge(['class' => 'w-full min-h-[44px] px-3 py-2 border border-border-core rounded-sm text-sm text-text-primary placeholder-text-muted bg-surface transition-all duration-150 focus:border-brand-blue focus:ring-3 focus:ring-brand-blue/20 focus:outline-none disabled:bg-bg-app disabled:text-text-muted']) }}>
