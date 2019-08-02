<?php
namespace App\Entity;

use App\Abstracts\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Auth\Bcrypt;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 */
class Usuario extends AbstractEntity
{

    /** @ORM\Column(type="string", length=100) **/
    private $login;

    /** @ORM\Column(type="string", length=100) **/
    private $senha;

    /**
     * @ORM\ManyToOne(targetEntity="Perfil")
     * @ORM\JoinColumn(nullable=false)
     */
    private $perfil;

    public function __construct(Array $data = [])
    {
        if (!empty($data['senha']))
            $this->senha = $data['senha'];

        /*
        if (!empty($data['password'])) {
            $bcrypt = new Bcrypt();
            $this->password = $bcrypt->setHash($data['password']);
        }
        */
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha): void
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getPerfil()
    {
        return $this->perfil;
    }

    /**
     * @param mixed $perfil
     */
    public function setPerfil($perfil): void
    {
        $this->perfil = $perfil;
    }


    public function __toArray()
    {
        $data = [];
        foreach ($this as $k=>$v)
            $data[$k] = $v;

        return $data;
    }


}