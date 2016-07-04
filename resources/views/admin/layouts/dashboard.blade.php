<!DOCTYPE html>
<html lang="en">
    <head>
        @include('admin.includes.head')
    </head>
    <body>
        <section id="container" class="">
            @include('admin.includes.header')
            @include('admin.includes.sidebar')

            @yield('content')
        </section>
        @yield('scripts')

    </body>
</html>


