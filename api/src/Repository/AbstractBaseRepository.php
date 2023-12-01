<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

abstract class AbstractBaseRepository extends ServiceEntityRepository
{
    private ManagerRegistry $registry;
    private string $entityClass;

    public function __construct(ManagerRegistry $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
        $this->registry = $registry;
        $this->entityClass = $entityClass;
    }

    public function getEntityManager(): EntityManagerInterface
    {
        if (!$this->_em->isOpen()) {
            /** @var EntityManagerInterface $em */
            $em = $this->registry->getManagerForClass($this->entityClass);
            $this->_em = $em;
        }

        return $this->_em;
    }

    public function save(): void
    {
        $this->getEntityManager()->flush();
    }

    public function persist(mixed $object): void
    {
        $this->getEntityManager()->persist($object);
    }

    public function remove(mixed $object): void
    {
        $this->getEntityManager()->remove($object);
    }

    public function refresh(mixed $object): void
    {
        $this->getEntityManager()->refresh($object);
    }
}
