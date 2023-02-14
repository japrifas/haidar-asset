<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand ">
            <a href=".">
                <img src="{{ asset('back/static/haidar.png') }}" alt="Tabler" class="navbar-brand-image">
            </a>
        </h1>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(2) == 'home' ? 'active' : '' }}"
                        href="{{ route('admin.home') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dashboard"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="13" r="2"></circle>
                                <line x1="13.45" y1="11.55" x2="15.5" y2="9.5"></line>
                                <path d="M6.4 20a9 9 0 1 1 11.2 0z"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Dashboard
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->segment(2) == 'assets' || request()->segment(2) == 'manufactures' ? 'show' : '' }}"
                        href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-archive"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z">
                                </path>
                                <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10"></path>
                                <path d="M10 12l4 0"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Assets
                        </span>
                    </a>
                    <div
                        class="dropdown-menu {{ request()->segment(2) == 'assets' || request()->segment(2) == 'manufactures' ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                @can('view asset')
                                    <a class="dropdown-item {{ request()->segment(2) == 'assets' ? 'active' : '' }}"
                                        href="{{ route('admin.assets') }}">
                                        Assets
                                    </a>
                                @endcan
                                @can('view manufacture')
                                    <a class="dropdown-item {{ request()->segment(2) == 'manufactures' ? 'active' : '' }}"
                                        href="{{ route('admin.manufactures') }}">
                                        Manufactures
                                    </a>
                                @endcan

                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->segment(2) == 'employees' || request()->segment(2) == 'organizations' ? 'show' : '' }}"
                        href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Employees
                        </span>
                    </a>
                    <div
                        class="dropdown-menu {{ request()->segment(2) == 'employees' || request()->segment(2) == 'organizations' ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                @can('view users')
                                    <a class="dropdown-item {{ request()->segment(2) == 'employees' ? 'active' : '' }}"
                                        href="{{ route('admin.employees') }}">
                                        Employees
                                    </a>
                                @endcan
                                @can('view role')
                                    <a class="dropdown-item {{ request()->segment(2) == 'organizations' ? 'active' : '' }}"
                                        href="{{ route('admin.organizations') }}">
                                        Organization
                                    </a>
                                @endcan

                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->segment(2) == 'users' || request()->segment(2) == 'roles' || request()->segment(2) == 'permissions' ? 'show' : '' }}"
                        href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Users
                        </span>
                    </a>
                    <div
                        class="dropdown-menu {{ request()->segment(2) == 'users' || request()->segment(2) == 'roles' || request()->segment(2) == 'permissions' ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                @can('view users')
                                    <a class="dropdown-item {{ request()->segment(2) == 'users' ? 'active' : '' }}"
                                        href="{{ route('admin.users') }}">
                                        User
                                    </a>
                                @endcan
                                @can('view role')
                                    <a class="dropdown-item {{ request()->segment(2) == 'roles' ? 'active' : '' }}"
                                        href="{{ route('admin.roles') }}">
                                        Roles
                                    </a>
                                @endcan
                                @can('view permission')
                                    <a class="dropdown-item {{ request()->segment(2) == 'permissions' ? 'active' : '' }}"
                                        href="{{ route('admin.permissions') }}">
                                        Permissions
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </li>



            </ul>
        </div>
    </div>
</aside>
