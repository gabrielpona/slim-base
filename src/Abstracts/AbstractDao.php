<?php
namespace App\Abstracts;

abstract class AbstractDao
{

    protected $entityManager;

    /**
     * AbstractDao constructor.
     * @param $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }


}
