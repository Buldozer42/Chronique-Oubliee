<?php

namespace App\Repository;

use App\Entity\Creature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Creature>
 *
 * @method Creature|null find($id, $lockMode = null, $lockVersion = null)
 * @method Creature|null findOneBy(array $criteria, array $orderBy = null)
 * @method Creature[]    findAll()
 * @method Creature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Creature::class);
    }

    public function add(Creature $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Creature $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByName(string $name): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.name LIKE :name')
            ->setParameter('name', '%' . $name . '%')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByFamily(string $family): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.family = :family')
            ->setParameter('family', $family)
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAllOrderBy(string $by, bool $asc): array
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.' . $by, $asc ? 'ASC' : 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByFamilyOrderBy(string $family, string $by, bool $asc) : array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.family = :family')
            ->setParameter('family', $family)
            ->orderBy('c.' . $by, $asc ? 'ASC' : 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAllFamily(): array{
        return $this->createQueryBuilder('c')
            ->select('c.family')
            ->distinct()
            ->orderBy('c.family', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAllBellowNc(int $nc): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.nc <= :nc')
            ->setParameter('nc', $nc)
            ->orderBy('c.nc', 'DESC')
            ->addOrderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findAllBellowNcOrderBy(int $nc, string $by, bool $asc): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.nc <= :nc')
            ->setParameter('nc', $nc)
            ->orderBy('c.' . $by, $asc ? 'ASC' : 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
//    /**
//     * @return Creature[] Returns an array of Creature objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Creature
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
