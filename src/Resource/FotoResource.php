<?php
/**
 * Created by PhpStorm.
 * User: gabrielmoreira
 * Date: 17/07/2019
 * Time: 10:44
 */

namespace App\Resource;

use App\Abstracts\AbstractResource;

class FotoResource extends AbstractResource
{


    public function findById($id, $array = true)
    {
        $repo = $this->entityManager->getRepository('App\Domain\Foto');
        $user = $repo->findOneBy(['id'=>$id]);

        if ($array and $user)
            $user = $user->__toArray();

        return $user;
    }




    public function list(){
        $fotos = $this->entityManager->getRepository('App\Domain\Foto')->findAll();
        $fotos = array_map(
            function ($foto) {
                return $foto->getArrayCopy();
            },
            $fotos
        );
        return $fotos;
    }


}