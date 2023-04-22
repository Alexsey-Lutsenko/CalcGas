<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')

    <!-- @vite('resources/css/app.css') -->
<!-- <link rel="stylesheet" href="{{ asset('css/app.css')  }}"> -->

{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">--}}

    <title>CalcGas</title>
</head>
<body>
<div id="app"></div>

@vite('resources/js/app.js')
<!-- <script src="{{ asset('js/app.js') }}"></script> -->

</body>
</html>
