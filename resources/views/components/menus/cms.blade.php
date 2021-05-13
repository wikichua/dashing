@php
    $id = 'cms-menu';
    foreach ($attributes as $key => $val) {
        $$key = $val;
    }
@endphp
@canany([
    'read-brands',
    'read-navs',
    'read-pages',
    'read-components',
    'read-carousels',
    'read-files',
    'read-pushers',
])
<li class="sidebar-item {{ $groupActive? 'active':'' }}">
    <a href="#{{ $id }}" data-bs-toggle="collapse" class="sidebar-link {{ $groupActive? '':'collapsed' }} bg-light text-dark">
        <i class="align-middle text-dark" data-feather="database"></i> <span class="align-middle">CMS</span>
    </a>
    <ul id="{{ $id }}" class="sidebar-dropdown list-unstyled {{ $groupActive? '':'collapse' }} " data-bs-parent="#sidebar">
            @can('read-brands')
            <x-dashing::menu-item :href="route('brand')" :active-pattern="'brand.*'" icon="fas fa-laptop">Brand</x-dashing::menu-item>
            @endcan
            @can('read-pages')
            <x-dashing::menu-item :href="route('page')" :active-pattern="'page.*'" icon="fas fa-blog">Page</x-dashing::menu-item>
            @endcan
            @can('read-navs')
            <x-dashing::menu-item :href="route('nav')" :active-pattern="'nav.*'" icon="fas fa-bars">Nav</x-dashing::menu-item>
            @endcan
            @can('read-components')
            <x-dashing::menu-item :href="route('component')" :active-pattern="'component.*'" icon="fas fa-cube">Component</x-dashing::menu-item>
            @endcan
            @can('read-carousels')
            <x-dashing::menu-item :href="route('carousel')" :active-pattern="'carousel.*'" icon="fas fa-images">Carousel</x-dashing::menu-item>
            @endcan
            @can('read-files')
            <x-dashing::menu-item :href="route('file')" :active-pattern="'file.*'" icon="fas fa-archive">Files</x-dashing::menu-item>
            @endcan
            @can('read-pushers')
            <x-dashing::menu-item :href="route('pusher')" :active-pattern="'pusher.*'" icon="fas fa-envelope-open-text">Pusher</x-dashing::menu-item>
            @endcan
    </ul>
</li>
@endcanany
