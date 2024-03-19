<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content={{ csrf_token() }}>
        <script>
            window.laravel = { csrfToken: '{{ csrf_token() }}'}
        </script>

        <link rel="stylesheet" href="{{mix('css/app.css')}}">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="icon" type="image/png" href='/images/favicon.ico'>
        <title>Crea persona</title>

        @yield('js-localization.head')
    </head>
    <body class="bg-white">
            <div>
        
        </div>
        <div id="app">
        <layout-div>
            <b-nav tabs class="mt-3">
                <b-nav-item active href="{{route('person-create')}}">Crea Nuovo</b-nav-item>
                <b-nav-item href="{{route('person-list')}}">Visualizza persone</b-nav-item>
            </b-nav>
            <person-create></person-create>
        </layout-div>
        </div>

        <script src="{{mix('js/app.js')}}"></script>
    </body>
</html>
