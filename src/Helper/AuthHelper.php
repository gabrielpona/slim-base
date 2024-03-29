<?php
/**
 * Created by PhpStorm.
 * User: gabrielmoreira
 * Date: 26/08/2019
 * Time: 15:06
 */

namespace App\Helper;


use App\Entity\Usuario;
use Doctrine\ORM\Mapping\Entity;

class AuthHelper
{
    public function __construct()
    {

    }


    public function check()
    {
        return isset($_SESSION['usuario']);
    }

    public function attempt($password,$usuario,$view)
    {

        $crypt = new CryptUtil(getenv("APP_KEY"));

        if(!$usuario){
            return false;
        }

        if(strcmp($crypt->encrypt($password), $usuario['senha'])==0){
            $_SESSION['usuario'] = $usuario;
            return true;
        }

        return false;

    }

    public function logout($view)
    {
        unset($_SESSION['usuario']);
    }
}