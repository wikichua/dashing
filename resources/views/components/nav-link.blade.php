@props(['active'])

@php
$active = ($active ?? false)
            ? 'active'
            : 'text-white';
@endphp

<li class="sidebar-item {{ $active }}">
    <a class="sidebar-link" {{ $attributes }}>
        {{ $slot }}
    </a>
</li>
