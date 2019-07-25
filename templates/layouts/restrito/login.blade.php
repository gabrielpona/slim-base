<!DOCTYPE html>
<html>
    @include('layouts.restrito.includes.head')
    <body class="login-page">
        @yield('conteudo')
    </body>
    <!-- jQuery 2.1.4 -->
    <script src="{{url('/assets/js/lib/jquery.min.js')}}" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{url('/assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <!--[if lt IE 9]>
    <script src="{{url('/assets/js/lib/bootstrap-datetimepicker-retrocompatibility.js')}}"></script>
    <![endif]-->
    <!-- AdminLTE App -->
    <script src="{{url('/assets/js/app.min.js')}}" type="text/javascript"></script>
</html>