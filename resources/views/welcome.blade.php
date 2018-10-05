<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="Description" content="A legnépszerűbb MTA szervereket listázó weboldal.">
        <meta name="theme-color" content="#F1F5F8"/>

        <title>MTASERVERS.EU</title>

        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body>
        <noscript>
            Javascript nélkül nem futtatható az oldal.
        </noscript>
        <div id="app">
            <main-app></main-app>
        </div>

        <script src="{{ asset('js/manifest.js') }}"></script>
        <script src="{{ asset('js/vendor.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
