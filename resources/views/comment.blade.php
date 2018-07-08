<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Simple Comment System</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-fixed-top" style="background: #ffffff;margin-bottom:20px">
                <div class="container">
                    <div class="navbar-header">
                    <a class="navbar-brand" href="#">Simple Comment System</a>
                    </div>
                    
                </div>
            </nav>
            <div class="container">
                <comment-component></comment-component>
            </div>
        </div>
    <script src="{{ asset('js/app.js') }}"></script>    
    </body>
</html>
