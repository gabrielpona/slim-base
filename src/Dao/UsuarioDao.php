<?php
namespace App\Dao;

use App\Abstracts\AbstractDao;
use App\Helper\Datatables\DataTablesHelper;

class UsuarioDao extends AbstractDao
{

    public function __construct($entityManager)
    {
        parent::__construct($entityManager,'App\Entity\Usuario');
    }

    public function findByLogin($login, $array = true)
    {
        $user = $this->repository->findOneBy(['login'=>$login]);
        if ($array and $user){
            $perfil = $user->getPerfil()!=null?$user->getPerfil()->__toArray():array();
            $unidade = $user->getUnidade()!=null?$user->getUnidade()->__toArray():array();
            $user = $user->__toArray();
            $user['perfil'] = $perfil;
            $user['unidade'] = $unidade;
        }
        return $user;
    }

    public function changePassword($userId,$oldPwd,$newPwd) {

        $usuario = $this->repo->findOneBy(['id'=>$userId]);
        if(strcmp($usuario->getSenha(),$oldPwd)==0){
            $usuario->setSenha($newPwd);
            $this->entityManager->persist($usuario);
        }else{
            throw new \Exception("Senha atual não confere.");
        }
        return $this->entityManager->flush();
    }

    public function listDtJson($search,$start,$length,$orderColumn,$orderDirection,$unidadeId){

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
        $sql .="  p.nome as 'perfil', ";
        $sql .="  un.sigla as 'unidade' ";
        $sql .=" FROM ";
        $sql .="  usuario u ";
        $sql .=" INNER JOIN perfil p ON u.perfil_id = p.id ";
        $sql .=" LEFT JOIN unidade un  ON u.unidade_id = un.id ";
        $sql .=" WHERE 1=1 ";

        if(!empty($search)){

            $sql.=" AND upper(u.nome) like '%".$search."%' ";
            $sql.=" OR upper(u.login) like '%".$search."%' ";
            $sql.=" OR upper(u.email) like '%".$search."%' ";
            $sql.=" OR upper(p.nome) like  '%".$search."%' ";
            $sql.=" OR upper(un.sigla) like  '%".$search."%' ";
            $sql.=" OR upper(un.nome) like  '%".$search."%' ";
        }

        if($unidadeId>0){
            $sql.=" AND un.id = ".$unidadeId;
        }

        $sql .=" ORDER BY  ".($orderColumn+1)." ".$orderDirection;

        $stmt = $conn->executeQuery($sql);
        $usuarios = $stmt->fetchAll();
        
        $dtHelper = new  DataTablesHelper();
        $datatables = $dtHelper->getDataTables($usuarios,$search,$start,$length,sizeof($usuarios));
        return $datatables;

    }

}