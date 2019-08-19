<?php
namespace App\Resource;

use App\Abstracts\AbstractDao;
use App\Entity\Usuario as Entity;
use App\Helper\Datatables\DataTablesHelper;


class UsuarioDao extends AbstractDao
{

    public function create(array $data)
    {
        $user = new Entity($data);
        $this->entityManager->persist($user);
        return $this->entityManager->flush();
    }

    public function createEntity(Entity $usuario)
    {


        //var_dump($usuario);
        $this->entityManager->persist($usuario);
        return $this->entityManager->flush();
    }


    public function listAll(){
        $repo = $this->entityManager->getRepository('App\Entity\Usuario');
        return $repo->findAll();
    }


    public function findById($id, $array = true)
    {
        $repo = $this->entityManager->getRepository('App\Entity\Usuario');
        $user = $repo->findOneBy(['id'=>$id]);

        if ($array and $user)
            $user = $user->__toArray();

        return $user;
    }


    public function findByLogin($login, $array = true)
    {
        $repo = $this->entityManager->getRepository('App\Entity\Usuario');
        $user = $repo->findOneBy(['login'=>$login]);


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
        $sql .="  u.nome, ";
        $sql .="  u.login, ";
        $sql .="  u.email, ";
        $sql .="  p.nome as 'perfil' ";
        $sql .=" FROM ";
        $sql .="  usuario u ";
        $sql .=" INNER JOIN perfil p ";
        $sql .=" ON u.perfil_id = p.id ";
        $sql .=" WHERE 1=1 ";


        if(!empty($search)){

            $sql.=" AND upper(u.nome) like '%".$search."%' ";
            $sql.=" OR upper(u.login) like '%".$search."%' ";
            $sql.=" OR upper(u.email) like '%".$search."%' ";
            $sql.=" OR upper(p.nome) like  '%".$search."%' ";
        }

        $sql .=" ORDER BY  ".($orderColumn+1)." ".$orderDirection;

        $stmt = $conn->executeQuery($sql);
        $usuarios = $stmt->fetchAll();
        
        $dtHelper = new  DataTablesHelper();
        $datatables = $dtHelper->getDataTables($usuarios,$search,$start,$length,sizeof($usuarios));
        return $datatables;

    }


}