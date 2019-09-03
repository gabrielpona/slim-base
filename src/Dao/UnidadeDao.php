<?php
/**
 * Created by PhpStorm.
 * User: gabrielmoreira
 * Date: 02/09/2019
 * Time: 14:35
 */

namespace App\Dao;

use App\Abstracts\AbstractDao;
use App\Abstracts\AbstractEntity;
use App\Helper\Datatables\DataTablesHelper;


class UnidadeDao extends AbstractDao
{
    private $repo;

    public function __construct($entityManager)
    {
        parent::__construct($entityManager);
        $this->repo = $this->entityManager->getRepository('App\Entity\Unidade');
    }

    public function listAll(){
        return $this->repo->findAll();
    }


    public function createEntity(AbstractEntity $unidade)
    {
        $this->entityManager->persist($unidade);
        return $this->entityManager->flush();
    }

    public function updateEntity(AbstractEntity $usuario)
    {
        $this->entityManager->merge($usuario);
        return $this->entityManager->flush();
    }

    public function findById($id, $array = true)
    {
        $user = $this->repo->findOneBy(['id'=>$id]);

        if ($array and $user)
            $user = $user->__toArray();

        return $user;
    }

    public function listDtJson($search,$start,$length,$orderColumn,$orderDirection){

        $conn = $this->entityManager->getConnection();

        //TODO: Not the best way to avoid SQL injections
        $search = strip_tags(trim($search));
        $search = str_replace("'", "", $search);
        $orderColumn = strip_tags(trim($orderColumn));
        $orderColumn = str_replace("'", "", $orderColumn);
        $orderDirection = strip_tags(trim($orderDirection));
        $orderDirection = str_replace("'", "", $orderDirection);

        $search = strtoupper($search);

        $sql = "SELECT";
        $sql .="  u.id as DT_RowId,";
        $sql .="  u.nome as nome, ";
        $sql .="  u.sigla as sigla ";
        $sql .=" FROM ";
        $sql .="  unidade u ";
        $sql .=" WHERE 1=1 ";

        if(!empty($search)){

            $sql.=" AND upper(u.nome) like '%".$search."%' ";
            $sql.=" OR upper(u.sigla) like '%".$search."%' ";
        }

        $sql .=" ORDER BY  ".($orderColumn+1)." ".$orderDirection;

        $stmt = $conn->executeQuery($sql);
        $unidades = $stmt->fetchAll();

        $dtHelper = new  DataTablesHelper();
        $datatables = $dtHelper->getDataTables($unidades,$search,$start,$length,sizeof($unidades));
        return $datatables;

    }

}