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

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * @param mixed $sigla
     */
    public function setSigla($sigla): void
    {
        $this->sigla = $sigla;
    }



    public function __toArray()
    {
        $data = [];
        foreach ($this as $k=>$v)
            $data[$k] = $v;

        return $data;
    }
}