<?php
namespace App\Model;

use App\Abstracts\AbstractResource;
use App\Domain\User as Entity;

class UserResource extends AbstractResource
{

    public function create(array $data)
    {
        $user = new Entity($data);
        $this->entityManager->persist($user);
        return $this->entityManager->flush();
    }

    public function findByUsername($username, $array = true)
    {
        $repo = $this->entityManager->getRepository('App\Domain\User');
        $user = $repo->findOneBy(['username'=>$username]);

        if ($array and $user)
            $user = $user->__toArray();

        return $user;
    }
}