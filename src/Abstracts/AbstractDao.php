<?php
namespace App\Abstracts;

abstract class AbstractDao
{

    protected $entityManager;

    protected $repository;

    /**
     * AbstractDao constructor.
     * @param $entityManager
     * @param $entityPath
     */
    public function __construct($entityManager,$entityPath)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository($entityPath);
    }

    public function createEntity(AbstractEntity $entity)
    {
        $this->entityManager->persist($entity);
        return $this->entityManager->flush();
    }

    public function updateEntity(AbstractEntity $entity)
    {
        $this->entityManager->merge($entity);
        return $this->entityManager->flush();
    }

    public function delete(AbstractEntity $entity){
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    public function findById($id, $array = true)
    {
        $entity = $this->repository->findOneBy(['id'=>$id]);
        if ($array and $entity)
            $entity = $entity->__toArray();
        return $entity;
    }

    public function listAll(){
        return $this->repository->findAll();
    }

}
