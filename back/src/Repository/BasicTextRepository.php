<?php

namespace App\Repository;

use App\Entity\BasicText;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BasicText>
 *
 * @method BasicText|null find($id, $lockMode = null, $lockVersion = null)
 * @method BasicText|null findOneBy(array $criteria, array $orderBy = null)
 * @method BasicText[]    findAll()
 * @method BasicText[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BasicTextRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BasicText::class);
    }

    //    /**
    //     * @return BasicText[] Returns an array of BasicText objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?BasicText
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
