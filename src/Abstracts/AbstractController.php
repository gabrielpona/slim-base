<?php
namespace App\Abstracts;

abstract class AbstractController
{

    protected $container;
    protected $dao;

    public function __construct($container,AbstractDao $dao) {
        $this->container = $container;
        $this->dao = $dao;
    }




}
