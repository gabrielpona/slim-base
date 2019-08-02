<?php
/**
 * Created by PhpStorm.
 * User: gabrielmoreira
 * Date: 02/08/2019
 * Time: 14:11
 */

namespace App\Transients\DataTables;


class DtPerfil implements DtWrapper
{
    private $DT_RowId;
    private $nome;
    private $slug;

    public function isEmpty()
    {
        return
            ($this->DT_RowId == null || $this->DT_RowId == 0) &&
            ( $this->nome == null || strcmp($this->nome, "")==0)&&
            ( $this->slug == null || strcmp($this->slug, "")==0);
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

}