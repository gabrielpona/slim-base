<?php
/**
 * Created by PhpStorm.
 * User: gabrielmoreira
 * Date: 26/07/2019
 * Time: 16:07
 */

namespace App\Controller;


class PainelController
{

    protected $container;

    public function __construct($container) {
        $this->container = $container;
    }


    public function getIndex($request, $response, $args){

        //return var_dump($this->container->view);
        return $this->container->view->render($response,'pages/painel/index.twig');
    }

}