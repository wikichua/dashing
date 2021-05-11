<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle d-flex">
        <i class="hamburger align-self-center"></i>
    </a>

    <x-dashing::searchable-input />

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <x-dashing::notification />
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="{{ '//ui-avatars.com/api/?name='.auth()->user()->name ?? '' }}" class="avatar img-fluid rounded me-1" alt="{{ auth()->user()->name ?? '' }}" /> <span class="text-dark">{{ auth()->user()->name ?? '' }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('profile') }}"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                    {{-- <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a> --}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
                    {{-- <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a> --}}
                    <div class="dropdown-divider"></div>
                    @impersonating
                    <a class="dropdown-item" href="{{ route('impersonate.leave') }}">
                        <i class="fas fa-people-arrows fa-fw me-1"></i>
                        Leave impersonation
                    </a>
                    @else
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-fw mre1"></i>
                        Logout
                    </a>
                    @endImpersonating
                </div>
            </li>
        </ul>
    </div>
</nav>
 <!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Click "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-primary">
                        {{ __('Log out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
