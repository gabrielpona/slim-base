<?php
/**
 * Created by PhpStorm.
 * User: gabrielmoreira
 * Date: 05/08/2019
 * Time: 10:04
 */

namespace App\Dao;


use App\Abstracts\AbstractDao;

class PerfilDao extends AbstractDao
{

    public function listAll(){
        $repo = $this->entityManager->getRepository('App\Entity\Perfil');
        return $repo->findAll();
    }


    public function findById($id, $array = true)
    {
        $repo = $this->entityManager->getRepository('App\Entity\Perfil');
        $user = $repo->findOneBy(['id'=>$id]);

        if ($array and $user)
            $user = $user->__toArray();

        return $user;
    }

}