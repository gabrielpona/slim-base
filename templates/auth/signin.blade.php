@extends('layouts.restrito.login')
@section('conteudo')
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Nome</b>Provisório</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Entre com seus dados para acessar</p>

            <form action="#" method="post">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <div class="social-auth-links text-center">
            </div>
            <a href="#">Esqueci a senha</a><br>
            <a href="#" class="text-center">Cadastre-se</a>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
@stop