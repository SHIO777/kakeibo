<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Laravel</title>
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
        {{-- <script src="{{ mix('/js/app.js') }}"></script> --}}

    </head>
<body>
    <div>
        <canvas id="myChart"></canvas>
    </div>
</body>
<script src="{{ mix('/js/chartjs.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>
</html>