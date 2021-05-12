<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('dashboard') }}">
            <x-dashing::application-logo />
            <span class="align-middle">{{ config('app.name','Laravel') }}</span>
        </a>

        <ul class="sidebar-nav">
            <x-dashing::nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <i class="align-middle" data-feather="sliders"></i>  <span class="align-middle">{{ __('Dashboard') }}</span>
            </x-dashing::nav-link>

            <x-dashing::admin-menu />

            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="pages-blank.html">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#auth" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Auth</span>
                </a>
                <ul id="auth" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-sign-in.html">Sign In</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-sign-up.html">Sign Up</a></li>
                </ul>
            </li> --}}
        </ul>
    </div>
</nav>
