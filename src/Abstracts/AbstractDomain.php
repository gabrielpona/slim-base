<?php

namespace App\Abstracts;

use Doctrine\ORM\Mapping as ORM;

abstract class AbstractDomain
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;



    /**
     * Get array copy of object
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function __toArray()
    {
        $data = [];
        foreach ($this as $k=>$v)
            $data[$k] = $v;

        return $data;
    }


}