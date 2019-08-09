<?php
namespace App\Resource;

use App\Abstracts\AbstractDao;
use App\Entity\Usuario as Entity;
use App\Helper\Datatables\DataTablesHelper;
use App\Transients\DataTables\DtUsuario;
use Doctrine\ORM\Query\ResultSetMapping;
use http\QueryString;
use PDO;

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

            $sql.=" AND upper(u.nome) like '%%s%' ";
            $sql.=" OR upper(u.login) like '%%s%' ";
            $sql.=" OR upper(u.email) like '%%s%'";
            $sql.=" OR upper(p.nome) like '%%s%'";

            $search = mysql_real_escape_string($search,$conn);
        }

        $sql .=" ORDER BY  %d %s";



        if(!empty($search)){
            $escapedSql = sprintf($sql,$search,($orderColumn+1),$orderDirection);
        }else{
            $escapedSql = sprintf($sql,($orderColumn+1),$orderDirection);
        }

        $stmt = $conn->executeQuery($escapedSql);
        $usuarios = $stmt->fetchAll();
        
        $dtHelper = new  DataTablesHelper();
        $datatables = $dtHelper->getDataTables($usuarios,$search,$start,$length,sizeof($usuarios));
        return $datatables;

    }

}