 <!-- Sidebar  -->
 <nav id="sidebar">
     <div class="sidebar-header">
         <h3>{{$settings->web_title}}</h3>
     </div>

     <ul class="list-unstyled components">
         @if(Auth::user())
         <div class="pb-3 text-center"> {{ Auth::user()->name }}
             <a class="btn btn-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                 {{ __('Logout') }}
             </a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                 @csrf
             </form>
         </div>
         @endif
         <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
             <a ia-expanded="false" href="{{ route('dashboard') }}">Dashboard</a>
         </li>
         <li class="{{ Request::is('patients') ? 'active' : '' }}">
             <a href="{{ route('patients') }}">Patients</a>
         </li>
         <li class="{{ Request::is('appointments') ? 'active' : '' }}">
             <a href="{{ route('appointments') }}">Appointments</a>
         </li>
         <li class="{{ Request::is('doctors') ? 'active' : '' }}">
             <a href="{{ route('doctors') }}">Doctors</a>
         </li>
         <li>
             <a data-target="#pageSubmenu" aria-controls="pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Settings</a>
             <ul class="collapse list-unstyled" id="pageSubmenu">
                 <li>
                     <a href="{{ route('settings') }}">General</a>
                 </li>
                 <li>
                     <a href="{{ route('roles') }}">Roles</a>
                 </li>
                 <li>
                     <a href="{{ route('users') }}">Users</a>
                 </li>
                 <li>
                     <a href="{{ route('profile') }}">Profile</a>
                 </li>
             </ul>
         </li>
     </ul>

     <ul class="list-unstyled CTAs">
         <li>
             <a href="" class="download">Download source</a>
         </li>
         <li>
             <a href="" class="article">Back to article</a>
         </li>
     </ul>
 </nav>