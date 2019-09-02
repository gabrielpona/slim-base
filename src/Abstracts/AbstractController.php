<?php
namespace App\Abstracts;

abstract class AbstractController
{

    protected $container;

    public function __construct($container) {
        $this->container = $container;
    }
}
