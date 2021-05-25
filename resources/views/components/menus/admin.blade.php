@php
    $id = 'admin-menu';
    foreach ($attributes as $key => $val) {
        $$key = $val;
    }
@endphp
@canany([
    'read-users',
    'read-reports',
    'read-cronjobs',
    'read-mailers',
])
<li class="sidebar-item {{ $groupActive? 'active':'' }}">
    <a href="#{{ $id }}" data-bs-toggle="collapse" class="sidebar-link {{ $groupActive? '':'collapsed' }} bg-light text-dark">
        <i class="align-middle text-dark" data-feather="cpu"></i> <span class="align-middle">Administrative</span>
    </a>
    <ul id="{{ $id }}" class="sidebar-dropdown list-unstyled {{ $groupActive? '':'collapse' }} " data-bs-parent="#sidebar">
            @can('read-users')
            <x-dashing::menu-item :href="route('user')" active-pattern="user.*">User</x-dashing::menu-item>
            @endcan
            @can('read-reports')
            <x-dashing::menu-item :href="route('report')" active-pattern="report.*">Report</x-dashing::menu-item>
            @endcan
            @can('read-cronjobs')
            <x-dashing::menu-item :href="route('cronjob')" active-pattern="cronjob.*">Cron Job</x-dashing::menu-item>
            @endcan
            @can('read-mailers')
            <x-dashing::menu-item :href="route('mailer')" :active-pattern="'mailer.*'">Mailers</x-dashing::menu-item>
            @endcan
    </ul>
</li>
@endcanany
