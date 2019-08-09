<?php
/**
 * Created by PhpStorm.
 * User: gabrielmoreira
 * Date: 30/07/2019
 * Time: 15:51
 */

namespace App\Transients\DataTables;
use App\Helper\Datatables\DtWrapper;

class DtUsuario implements DtWrapper
{

    private $DT_RowId;
    private $nome;
    private $login;
    private $email;
    private $perfil;


    public function isEmpty()
    {
       return
           ($this->DT_RowId == null || $this->DT_RowId == 0) &&
           ( $this->login == null || strcmp($this->login, "")==0) &&
           ( $this->nome == null || strcmp($this->nome, "")==0) &&
           ( $this->email == null || strcmp($this->email, "")==0) &&
           ( $this->perfil == null || strcmp($this->perfil, "")==0);
    }

    /**
     * @return mixed
     */
    public function getDTRowId()
    {
        return $this->DT_RowId;
    }

    /**
     * @param mixed $DT_RowId
     */
    public function setDTRowId($DT_RowId): void
    {
        $this->DT_RowId = $DT_RowId;
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
    }/**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }/**
    * @param mixed $email
    */
    public function setEmail($email): void
    {
        $this->email = $email;
    }







}