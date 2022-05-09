<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            {{ __('Dashboard') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
            </svg>
            {{ __('Users') }}
        </a>
    </li>

    <li class="nav-group" aria-expanded="{{ request()->routeIs('module-categories.index') || request()->routeIs('modules*') ? 'true' : 'false' }}">
        <a class="nav-link nav-group-toggle" href="javascript:void(0)">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-layers') }}"></use>
            </svg>
            {{ __('Modules') }}
        </a>
        <ul class="nav-group-items" style="height: {{ request()->routeIs('module-categories.index') || request()->routeIs('modules*') ? 'auto' : '0px' }};">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('module-categories.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-hamburger-menu') }}"></use>
                    </svg>
                    Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('modules*') ? 'active' : '' }}" href="{{ route('modules.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    {{ __('Modules') }}
                </a>
            </li>
        </ul>
    </li>
</ul>
