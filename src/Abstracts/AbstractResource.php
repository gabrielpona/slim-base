<?php
namespace App\Abstracts;

abstract class AbstractResource
{

    protected $entityManager;

    /**
     * AbstractResource constructor.
     * @param $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }


}
