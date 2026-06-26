<!-- 
  Aturan Card dari contentful.com-DESIGN.md:
  - Background: #FFFFFF (bg-surface)
  - Border: 1px solid #E5EBED (border-border-subtle)
  - Radius: 6px (rounded-md)
  - Padding: 16px (p-4)
  - Elevation Raised: 0 1px 2px rgba(0,0,0,0.1) (shadow-raised)
-->
<div {{ $attributes->merge(['class' => 'bg-surface border border-border-subtle rounded-md shadow-raised p-4 relative']) }}>
    {{ $slot }}
</div>
