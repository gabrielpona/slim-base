<header class="main-header">

    <!-- Logo -->
    <a href="{{url('/restrito')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><img src="{{url('/assets/img/logo-mini.png')}}" class="img-circle" alt="APP" style="max-height: 30px;" /></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">{{appName()}}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="{{url('/restrito')}}" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Alternar navegação</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages -->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Mensagens recebidas" id="count-notification-label">
                        <i class="fa fa-envelope-o"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Você tem <span id="count-notification-counter">0</span> mensage<span id="count-notification-plural">m</span></li>
                        <li>
                            <ul class="menu" id="list-notification-container">

                            </ul><!-- /.menu -->
                        </li>
                        <li class="footer"><a href="#">Ver todas as mensagens</a></li>
                    </ul>
                </li><!-- /.messages-menu -->

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="{{url('/restrito')}}" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                    <img src="{{url('/assets/img/default_user.gif')}}" class="user-image" alt="Imagem do usuário"/>
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs">NOME USUARIO</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{url('/assets/img/default_user.gif')}}" class="img-circle" alt="Imagem do usuário" />
                            <p>
                                Nome Usuário
                                <small>Login</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#change-my-password-modal" data-toggle="modal" class="btn btn-sm btn-default btn-flat">
                                    <i class="fa fa-lock"></i> Alterar senha
                                </a>
                            </div>
                            <div class="pull-right">
                                <a href="{{url('/logout')}}" class="btn btn-sm btn-default btn-flat" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>Sair
                                    <form id="logout-form" action="#" method="POST" style="display: none;">
                                    </form>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>