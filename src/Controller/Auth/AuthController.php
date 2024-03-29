<?php

namespace App\Controller\Auth;

use App\Entity\User;
use App\Helper\AuthHelper;
use App\Helper\CryptUtil;
use App\Dao\UsuarioDao;

class AuthController
{

    /* -----Move to superclass ----*/

    protected $container;
    private $usuarioDao;
    private $authHelper;


    public function __construct($container)
    {
        $this->container = $container;
        $this->usuarioDao = new UsuarioDao($container->get('em'));
        $this->authHelper = new AuthHelper();
    }

    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }

    /*--------------------------------------*/


    /*
    public function user()
    {
        //return User::find(isset($_SESSION['user']) ? $_SESSION['user'] : 0);
        $user = null;
        if(isset($_SESSION['usuario'])){
            $user = $_SESSION['usuario'];
        }else{
            $user = $this->userResource->findById($_SESSION['usuario']);
        }
        return $user;
    }

    */

    public function postSignOut($request, $response)
    {
        $this->authHelper->logout($this->container->view);
        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function getSignIn($request, $response)
    {
        return $this->container->view->render($response,'pages/auth/signin.twig');
    }

    public function postSignIn($request, $response)
    {

        $login = $request->getParam('login');
        $senha = $request->getParam('senha');
        $usuario = $this->usuarioDao->findByLogin($login);

        $auth = $this->authHelper->attempt($senha,$usuario,$this->container->view);

        if (! $auth) {
            $this->flash->addMessage('error', 'Beh! Could not sign you in with those details');
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }

        return $response->withRedirect($this->router->pathFor('painel.index'));

    }

    public function getSignUp($request, $response)
    {
        echo 'Signup';
    }

    public function postSignUp($request, $response)
    {
        return $response->withRedirect($this->router->pathFor('home'));
    }

}