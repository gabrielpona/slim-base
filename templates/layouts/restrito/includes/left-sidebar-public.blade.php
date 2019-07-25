<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{url('/assets/img/default_user.gif')}}" class="img-circle" alt="Imagem do usuário"/>
            </div>
            <div class="pull-left info">
                <p>NOME USUARIO</p>
                <!-- Status -->
                <a href="{{url('/assets/img/default_user.gif')}}"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">MENU PRINCIPAL</li>

            <li class="treeview"> <!--active?-->
                <a href="#">
                <i class="fa fa-ticket"></i>
                <span>ITEM 1</span>
                </a>
            </li>
            <li class="treeview">
                <ul class="treeview-menu">
                    <li class=""><!--active?-->
                        <a href="#"><i class='fa fa-circle'></i>
                        <span>...</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>ITEM 2</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class=""><!--active?-->
                        <a href="#"><i class='fa fa-money'></i>
                        <span>SUB 1</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>