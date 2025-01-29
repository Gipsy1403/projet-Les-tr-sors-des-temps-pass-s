<?php

namespace App\Repository;

use App\Entity\Umbrella;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Umbrella>
 */
class UmbrellaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Umbrella::class);
    }


    public function filterAsc(): array
       {
           return $this->createQueryBuilder('u')
               ->orderBy('u.title', 'ASC')
               ->getQuery()
               ->getResult()
           ;
       }

	  public function filterCategory(): array
       {
           return $this->createQueryBuilder('u')
		 	->leftJoin("u.category", "c")
		 	->andWhere("c.category = :category")
               ->setParameter(':category', '$category')
               ->getQuery()
               ->getResult()
           ;
       }

	
//    /**
//     * @return Umbrella[] Returns an array of Umbrella objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Umbrella
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
