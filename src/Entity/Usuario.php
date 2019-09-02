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
    private $nome;

    /** @ORM\Column(type="string", length=100) **/
    private $email;

    /** @ORM\Column(type="string", length=100) **/
    private $login;

    /** @ORM\Column(type="string", length=100) **/
    private $senha;

    /**
     * @ORM\ManyToOne(targetEntity="Perfil",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,referencedColumnName="id")
     */
    private $perfil;

    /**
     * @ORM\ManyToOne(targetEntity="Unidade",cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,referencedColumnName="id")
     */
    private $unidade;

    /** @ORM\Column(type="boolean", length=100) **/
    private $ativo;

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

    /**
     * @return mixed
     */
    public function getUnidade()
    {
        return $this->unidade;
    }

    /**
     * @param mixed $unidade
     */
    public function setUnidade($unidade): void
    {
        $this->unidade = $unidade;
    }



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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param mixed $ativo
     */
    public function setAtivo($ativo): void
    {
        $this->ativo = $ativo;
    }




    public function __toArray()
    {
        $data = [];
        foreach ($this as $k=>$v)
            $data[$k] = $v;

        return $data;
    }


}