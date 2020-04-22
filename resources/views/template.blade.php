<!DOCTYPE html>
<html>
    <head>
        <title>Siswaku</title>
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        {{-- memanggil bootstrap komentar ini tidak akan tampak dibrowser --}}
        <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
    </head>
    <body>

       <div class="container">
           @include('navbar')
           @yield('main')
       </div>
       @yield('footer')
    <script src="{{asset('js/jquery_2_2_1.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    </body>
</html>
