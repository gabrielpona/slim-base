<?php
/**
 * Created by PhpStorm.
 * User: gabrielmoreira
 * Date: 30/08/2019
 * Time: 16:34
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Abstracts\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="unidade")
 */
class Unidade extends AbstractEntity
{

    /** @ORM\Column(type="string", length=100) **/
    private $nome;

    /** @ORM\Column(type="string", length=100) **/
    private $sigla;

    public function __toArray()
    {
        $data = [];
        foreach ($this as $k=>$v)
            $data[$k] = $v;

        return $data;
    }
}