<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.includes.head-dashboard')
</head>

<body>
    <div id="app">
        <div class="wrapper">
            @include('layouts.includes.header-dashboard')

            <!-- Page Content  -->
            <div id="content">

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <button type="button" id="sidebarCollapse" class="btn btn-info">
                            <i class="fas fa-align-left text-white"></i>
                            <span class="text-white">Toggle Sidebar</span>
                        </button>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-align-justify"></i>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav navbar-nav ml-auto">
                                <button type="button" class="btn btn-primary position-relative">
                                    Info <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-2"><span class="visually-hidden">unread messages</span></span>
                                </button>
                                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                                    <a class="nav-link" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/">Our doctors</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                @include('flash-message')
                @yield('content')
            </div>
        </div>

    </div>
    @include('layouts.includes.footer')
    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip({
                placement: 'bottom'
            })
            $('.selectpicker').selectpicker();
            setTimeout(function() {
                $(".alert").fadeOut("slow");
            }, 3000);
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    @yield('additional_scripts')
</body>

</html>