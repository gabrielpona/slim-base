<?php

namespace App\Controller\Auth;

use App\Domain\User;

class AuthController
{

    /* -----Move to superclass ----*/

    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }

    /*--------------------------------------*/

    public function user()
    {
        //return User::find(isset($_SESSION['user']) ? $_SESSION['user'] : 0);
        return new User();
    }

    public function check()
    {
        return isset($_SESSION['user']);
    }

    public function attempt($email, $password)
    {


        return false;

        /*
        $user = User::where('email', $email)->first();

        if (! $user) {
            return false;
        }

        if (password_verify($password, $user->password)) {
            $_SESSION['user'] = $user->id;
            return true;
        }

        return false;
        */
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }


    /**********CONTROLLER SLIMBORN*********/


    public function getSignOut($request, $response)
    {
        $this->auth->logout();
        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function getSignIn($request, $response)
    {
        //return $this->view->render($response, 'auth/signin.twig');
        return $this->container->view->render($response, 'auth.signin', ['name' => 'a']);
    }

    public function postSignIn($request, $response)
    {
        $auth = $this->auth->attempt(
            $request->getParam('email'),
            $request->getParam('password')
        );

        if (! $auth) {
            $this->flash->addMessage('error', 'Could not sign you in with those details');
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }

        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function getSignUp($request, $response)
    {
        //return $this->view->render($response, 'auth/signup.twig');
        echo 'Signup';
    }

    public function postSignUp($request, $response)
    {


        /*

        $validation = $this->validator->validate($request, [
            'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
            'name' => v::noWhitespace()->notEmpty()->alpha(),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('auth.signup'));
        }

        $user = User::create([
            'email' => $request->getParam('email'),
            'name' => $request->getParam('name'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
        ]);

        $this->flash->addMessage('info', 'You have been signed up');

        $this->auth->attempt($user->email,$request->getParam('password'));

        */

        return $response->withRedirect($this->router->pathFor('home'));
    }








}