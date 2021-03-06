<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">Innovative Logistics</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
            </ul>
            {{--  Auth navigation  --}}
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/login"><i class="fas fa-sign-in-alt"></i>Login</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#!" data-toggle="dropdown">
                            {{ auth()->user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @if(auth()->user()->role_id == 1)
                                <a class="dropdown-item" href="/user/trucks"><i class="fas fa-user-cog"></i>My Trucks</a>
                                <a class="dropdown-item" href="/user/schedules"><i class="fas fa-user-cog"></i>My Schedules</a>
                            @endif
                            @if(auth()->user()->role_id == 2)
                                <a class="dropdown-item" href="/admin/bays"><i class="fas fa-user-cog"></i>Bays</a>
                                <a class="dropdown-item" href="/admin/trucks"><i class="fas fa-key"></i>Trucks</a>
                                <a class="dropdown-item" href="/admin/schedules"><i class="fas fa-box-open"></i>Schedule</a>
                                <a class="dropdown-item" href="/admin/users"><i class="fas fa-box-open"></i>Users</a>
                            @endif
                            @if(auth()->user()->role_id == 3)
                                <a class="dropdown-item" href="/logistics/bays"><i class="fas fa-user-cog"></i>Bays</a>
                                <a class="dropdown-item" href="/logistics/trucks"><i class="fas fa-key"></i>Trucks</a>
                                <a class="dropdown-item" href="/logistics/schedules"><i class="fas fa-box-open"></i>Schedule</a>
                            @endif
                            @if(auth()->user()->role_id == 4)
                                <a class="dropdown-item" href="/loading/bays"><i class="fas fa-user-cog"></i>My Bays</a>
                                <a class="dropdown-item" href="/loading/schedule"><i class="fas fa-key"></i>My Schedule</a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
