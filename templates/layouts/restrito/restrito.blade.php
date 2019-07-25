<!DOCTYPE html>
<html>
    @include('layouts.restrito.includes.head')
    <body class="skin-blue sidebar-open sidebar-mini">
        <!--TODO:Adicionar Modais-->
        <!--TODO:Adicionar Modais Locais-->
        <div class="wrapper">
            @include('layouts.restrito.includes.top-menu')
            @include('layouts.restrito.includes.left-sidebar-public')

            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 class="pull-left">
                        <!--<decorator:getProperty property="page.local_title"/>-->
                        Título
                        <small>Subtítulo<!--<decorator:getProperty property="page.local_subtitle"/>--></small>
                    </h1>
                    <div class="pull-right">
                        <!--<decorator:getProperty property="page.local_controls"/>-->
                    </div>
                    <div class="clearfix"></div>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- TODO:TOASTER
                    <div class="alert ${classeAlerta != null ? classeAlerta : 'alert-danger'}" style="display: none" data-toastr-type="${toastrType}">
                        <a href="#" class="close xbtn" data-dismiss="alert">&times;</a>
                        <span class="texto">${alerta}${causa}</span>
                        <c:if test="${not alerta eq ''}">
                            <br/>
                        </c:if>
                        <c:forEach var="error" items="${errors}">
                            <span class="texto">${error.category} - ${error.message}</span><br/>
                        </c:forEach>
                    </div>
                    -->
                    @yield('conteudo')

                </section><!-- /.content -->
            </div>
        </div>
    </body>
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Ambiente: ENV_NAME | Perfil: PROFILE_NAME
        </div>
        <!-- Default to the left -->
        <span>Versão: 1.0.0</span>
    </footer>

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