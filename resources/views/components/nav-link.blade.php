@props(['active'])

@php
$active = ($active ?? false)
            ? 'active'
            : 'text-dark';
@endphp

<li class="sidebar-item {{ $active }}">
    <a class="sidebar-link bg-light text-dark" {{ $attributes }}>
        {{ $slot }}
    </a>
</li>
