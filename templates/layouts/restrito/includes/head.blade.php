
<head>
    <meta charset="UTF-8">
    <title>{{appName()}} | Página</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="{{ url('/assets/img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ url('/assets/img/favicon.ico')}}" type="image/x-icon">

    <!-- Bootstrap 3.3.4 -->
    <link href="{{  url('/assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{ url('/assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{ base_url.'/assets/css/ionicons.min.css'}}" rel="stylesheet" type="text/css" />

    <!-- Plugins and Libraries -->
    <link href="{{ url('/assets/plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href="{{ url('/assets/plugins/jQuery-contextMenu/jquery.contextMenu.min.css')}}" rel="stylesheet">
    <link href="{{ url('/assets/css/lib/bootstrap-datetimepicker.css')}}" rel="stylesheet">
    <link href="{{ url('/assets/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{ url('/assets/plugins/select2/select2.min.css')}}" rel="stylesheet">
    <!--
    <link href="${environment.get("config.app_address")}<c:url value="/assets/css/lib/multi-select.css"/>" rel="stylesheet">
    <link href="${environment.get("config.app_address")}<c:url value="/assets/css/lib/jquery.webui-popover.min.css"/>" rel="stylesheet">
    <link href="${environment.get("config.app_address")}<c:url value="/assets/plugins/pace/pace.css"/>" rel="stylesheet">
-->

    <!-- Theme style -->
    <link href="{{ url('/assets/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/assets/css/skins/skin-blue.min.css')}}" rel="stylesheet" type="text/css" />
</head>