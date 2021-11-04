<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img id="navbar-logo" src="{{ asset('storage/images/logo/'.$settings->logo_path) }}" alt="{{$settings->logo_path}}" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav main-menu mr-auto">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Our doctors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Contact</a>
                </li>
                @if(Auth::user())
                <li class="nav-item {{ Request::is('patients') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('patients') }}">Patients</a>
                </li>
                <li class="nav-item {{ Request::is('appointments') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('appointments') }}">Appointments</a>
                </li>
                @endif
                @role('Admin')
                <li class="nav-item {{ Request::is('doctors') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('doctors') }}">Doctors</a>
                </li>
                @endrole
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white" href="{{ route('login') }}">{{ __('Login') }} <i class="bi bi-box-arrow-in-right fa-lg"></i></a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown bg-primary">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white shadow-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="bi bi-person-circle fa-lg"></i> {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                        <a class="dropdown-item {{ Request::is('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                            Profile
                        </a>
                        @role('Admin')
                        <a class="dropdown-item {{ Request::is('users') ? 'active' : '' }}" href="/settings">Settings</a>
                        @endrole
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>