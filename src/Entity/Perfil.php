<?php
/**
 * Created by PhpStorm.
 * User: gabrielmoreira
 * Date: 02/08/2019
 * Time: 14:08
 */

namespace App\Entity;

use App\Abstracts\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="perfil")
 */
class Perfil extends AbstractEntity
{

    /** @ORM\Column(type="string", length=100) **/
    private $nome;

    /** @ORM\Column(type="string", length=20) **/
    private $slug;

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
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }



    public function __toArray()
    {
        $data = [];
        foreach ($this as $k=>$v)
            $data[$k] = $v;

        return $data;
    }

}