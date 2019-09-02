<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class UnidadeController extends AbstractController
{

    protected $container;

    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function getList($request, $response, $args){
        return $this->container->view->render($response,'unidade/list.twig',array());
    }

}