<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.includes.head')
</head>

<body>
    <div id="app">
        @include('layouts.includes.header')

        @yield('home-cover')

        <main class="py-4 container bg-white shadow-sm mt-4">
            @include('flash-message')
            @yield('content')
        </main>

    </div>
    @include('layouts.includes.footer')
    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip({
                placement: 'bottom'
            })
            $('.selectpicker').selectpicker({
                size: 3,
                style: '',
                styleBase: 'form-control shadow-none'
            });
            setTimeout(function() {
                $(".alert").fadeOut("slow");
            }, 3000);
        });
    </script>
    @yield('additional_scripts')
</body>

</html>