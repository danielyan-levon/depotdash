<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Depot Dash | Warehouse &amp; Pallet Storage | Logistics | Manchester UK</title>
        <meta charset="UTF-8"/>     
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="{{asset('css/main.css')}}"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    </head>

    <body>
        <div id="main">
            @include('includes.header')
            <div class='main-wrapper'>
                @yield('content')

                @yield('scripts')
            </div> 
        </div>
        @include('includes.footer')   
    </body>
</html>