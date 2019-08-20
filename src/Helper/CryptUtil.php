<?php
/**
 * Created by PhpStorm.
 * User: gabrielmoreira
 * Date: 20/08/2019
 * Time: 10:14
 */

namespace App\Helper;


class CryptUtil
{

    private $salt;

    public function __construct($salt)
    {
        $this->salt = $salt;
    }

    public function encrypt($input){
        return sha1($this->salt.$input);
    }

}