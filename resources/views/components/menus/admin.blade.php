@php
    $id = 'admin-menu';
    foreach ($attributes as $key => $val) {
        $$key = $val;
    }
@endphp
@canany([
    'read-users',
    'read-roles',
    'read-permissions',
    'read-settings',
    'read-audits',
    'read-log-viewer',
    'read-reports',
    'read-cronjobs',
    'read-failed-jobs',
    'read-mailers',
    'read-versionizers',
])
<li class="sidebar-item {{ $groupActive? 'active':'' }}">
    <a href="#{{ $id }}" data-bs-toggle="collapse" class="sidebar-link {{ $groupActive? '':'collapsed' }} bg-light text-dark">
        <i class="align-middle text-dark" data-feather="cpu"></i> <span class="align-middle">Administrative</span>
    </a>
    <ul id="{{ $id }}" class="sidebar-dropdown list-unstyled {{ $groupActive? '':'collapse' }} " data-bs-parent="#sidebar">
            @can('read-users')
            <x-dashing::menu-item :href="route('user')" active-pattern="user.*" icon="fas fa-users">User</x-dashing::menu-item>
            @endcan
            @can('read-roles')
            <x-dashing::menu-item :href="route('role')" active-pattern="role.*" icon="fas fa-id-badge">Role</x-dashing::menu-item>
            @endcan
            @can('read-permissions')
            <x-dashing::menu-item :href="route('permission')" active-pattern="permission.*" icon="fas fa-lock">Permission</x-dashing::menu-item>
            @endcan
            @can('read-settings')
            <x-dashing::menu-item :href="route('setting')" active-pattern="setting.*" icon="fas fa-cogs">Setting</x-dashing::menu-item>
            @endcan
            @can('read-audits')
            <x-dashing::menu-item :href="route('audit')" active-pattern="audit.*" icon="fas fa-stream">Audit</x-dashing::menu-item>
            @endcan
            @can('read-reports')
            <x-dashing::menu-item :href="route('report')" active-pattern="report.*" icon="fas fa-file-contract">Report</x-dashing::menu-item>
            @endcan
            @can('read-cronjobs')
            <x-dashing::menu-item :href="route('cronjob')" active-pattern="cronjob.*" icon="fas fa-voicemail">Cron Job</x-dashing::menu-item>
            @endcan
            @can('read-log-viewer')
            <x-dashing::menu-item :href="route('logviewer')" active-pattern="logviewer.*" icon="fas fa-bug">Log Viewer</x-dashing::menu-item>
            @endcan
            @can('read-failed-jobs')
            <x-dashing::menu-item :href="route('failedjob')" active-pattern="failedjob.*" icon="fas fa-recycle">Failed Job</x-dashing::menu-item>
            @endcan
            @can('read-mailers')
            <x-dashing::menu-item :href="route('mailer')" :active-pattern="'mailer.*'" icon="fas fa-mail-bulk">Mailers</x-dashing::menu-item>
            @endcan
            @can('read-versionizers')
            <x-dashing::menu-item :href="route('versionizer')" :active-pattern="'versionizer.*'" icon="fas fa-code-branch">Versionizers</x-dashing::menu-item>
            @endcan
    </ul>
</li>
@endcanany
