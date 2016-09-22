{{--
|--------------------------------------------------------------------------
| Layout général
|--------------------------------------------------------------------------
|
| C'est la base de chaque page du site (sauf le login)
| Cette base fait appel à une navbar (section nav) et au corps (content).
|
--}}

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LAM - @yield('title')</title>
  <link rel="stylesheet" href="{{ URL::asset('bower/bootstrap/dist/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('bower/font-awesome/css/font-awesome.min.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('bower/animate.css/animate.min.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('bower/select2/dist/css/select2.min.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('custom/dataTables.min.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('bower/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}"/>
  <link rel="stylesheet" href="{{ URL::asset('bower/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('bower/nprogress/nprogress.css')}}" />
  <link rel="stylesheet" href="{{ URL::asset('custom/style.css') }}" />
</head>
<body>
  <div class="container">
    @yield('nav')
    @yield('content')
  </div>
  <script src="{{ URL::asset('bower/moment/min/moment.min.js') }}"></script>
  <script src="{{ URL::asset('bower/moment/min/moment-with-locales.min.js') }}"></script>
  <script src="{{ URL::asset('bower/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ URL::asset('bower/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ URL::asset('bower/select2/dist/js/select2.min.js') }}" ></script>
  <script src="{{ URL::asset('bower/nprogress/nprogress.js') }}" ></script>
  <script src="{{ URL::asset('custom/dataTables.min.js') }}" ></script>
  <script src="{{ URL::asset('custom/dataTablesBootstrap.min.js') }}" ></script>
  <script src="{{ URL::asset('custom/sign.min.js') }}" ></script>
  <script src="{{ URL::asset('bower/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
  @yield('customJs')
</body>

</html>
