<?php
namespace App\Resource;

use App\Abstracts\AbstractDao;
use App\Entity\User as Entity;
use App\Helper\Datatables\DataTablesHelper;
use App\Transients\DataTables\DtUsuario;
use Doctrine\ORM\Query\ResultSetMapping;

class UsuarioDao extends AbstractDao
{

    public function create(array $data)
    {
        $user = new Entity($data);
        $this->entityManager->persist($user);
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


    public function listDtJson(DtUsuario $dtUsuario,$search,$start,$length,$orderColumn,$orderDirection){

        $sql = "SELECT";
        $sql .="  u.id as DT_RowId,";
        $sql .="  u.login, ";
        $sql .="  p.nome as 'perfil' ";
        $sql .=" FROM ";
        $sql .="  usuario u ";
        $sql .=" INNER JOIN perfil p ";
        $sql .=" ON u.perfil_id = p.id ";
        $sql .=" WHERE 1=1 ";


        $conn = $this->entityManager->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $usuarios = $stmt->fetchAll();

        $dtHelper = new  DataTablesHelper();
        $datatables = $dtHelper->getDataTables($usuarios,$search,$start,$length,sizeof($usuarios));
        return $datatables;

    }

}