@php
    $id = 'system-menu';
    foreach ($attributes as $key => $val) {
        $$key = $val;
    }
@endphp
@canany([
    'read-roles',
    'read-permissions',
    'read-settings',
    'read-audits',
    'read-log-viewer',
    'read-failed-jobs',
    'read-versionizers',
    'read-caches',
])
<li class="sidebar-item {{ $groupActive? 'active':'' }}">
    <a href="#{{ $id }}" data-bs-toggle="collapse" class="sidebar-link {{ $groupActive? '':'collapsed' }} bg-light text-dark">
        <i class="align-middle text-dark" data-feather="sliders"></i> <span class="align-middle">System</span>
    </a>
    <ul id="{{ $id }}" class="sidebar-dropdown list-unstyled {{ $groupActive? '':'collapse' }} " data-bs-parent="#sidebar">
            @can('read-roles')
            <x-dashing::menu-item :href="route('role')" active-pattern="role.*">Role</x-dashing::menu-item>
            @endcan
            @can('read-permissions')
            <x-dashing::menu-item :href="route('permission')" active-pattern="permission.*">Permission</x-dashing::menu-item>
            @endcan
            @can('read-settings')
            <x-dashing::menu-item :href="route('setting')" active-pattern="setting.*">Setting</x-dashing::menu-item>
            @endcan
            @can('read-audits')
            <x-dashing::menu-item :href="route('audit')" active-pattern="audit.*">Audit</x-dashing::menu-item>
            @endcan
            @can('read-log-viewer')
            <x-dashing::menu-item :href="route('logviewer')" active-pattern="logviewer.*">Log Viewer</x-dashing::menu-item>
            @endcan
            @can('read-failed-jobs')
            <x-dashing::menu-item :href="route('failedjob')" active-pattern="failedjob.*">Failed Job</x-dashing::menu-item>
            @endcan
            @can('read-versionizers')
            <x-dashing::menu-item :href="route('versionizer')" :active-pattern="'versionizer.*'">Versionizers</x-dashing::menu-item>
            @endcan
            @can('read-caches')
            <x-dashing::menu-item :href="route('cache')" :active-pattern="'cache.*'">Caches</x-dashing::menu-item>
            @endcan
    </ul>
</li>
@endcanany
