<x-dashing::menu menu="system" :active-patterns="[
    'permission.*',
    'role.*',
    'setting.*',
    'audit.*',
    'logviewer.*',
    'failedjob.*',
    'versionizer.*',
    'cache.*',
]"/>
<x-dashing::menu menu="admin" :active-patterns="[
    'user.*',
    'pat.*',
    'report.*',
    'cronjob.*',
    'mailer.*',
]"/>
<x-dashing::menu menu="cms" :active-patterns="[
    'brand.*',
    'page.*',
    'nav.*',
    'component.*',
    'carousel.*',
    'file.*',
    'pusher.*',
]"/>
{{-- @if (Route::has('opcache.home'))
<x-dashing::nav-link :href="route('opcache.home')" :active="request()->routeIs('opcache.home')">
    <i class="align-middle fas fa-boxes"></i><span class="align-middle">OpCache Manager</span>
</x-dashing::nav-link>
@endif
@if (Route::has('lfm.home'))
<x-dashing::nav-link :href="route('lfm.home')" :active="request()->routeIs('lfm.home')">
    <i class="align-middle fas fa-folder"></i><span class="align-middle">File Manager</span>
</x-dashing::nav-link>
@endif
@if (Route::has('seo.home'))
@can('Manage SEO')
<x-dashing::nav-link :href="route('seo.home')" :active="request()->routeIs('seo.home')">
    <i class="align-middle fas fa-folder"></i><span class="align-middle">SEO Manager</span>
</x-dashing::nav-link>
@endcan
@endif
 --}}
@if (Route::has('wiki.home'))
@can('read-wiki-docs')
<x-dashing::nav-link :href="route('wiki.home')" :active="request()->routeIs('wiki.home')">
    <i class="align-middle fab fa-wikipedia-w text-dark"></i><span class="align-middle">Wiki Docs</span>
</x-dashing::nav-link>
@endcan
@endif
<x-dashing::custom-admin-menu />
{{-- @foreach ($brandMenus as $brandMenu)
@include($brandMenu)
@endforeach --}}
