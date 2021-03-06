<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    /**
    * @return Recipe[] Returns an array of Recipe objects
    */

    public function findByByCategory($value) : array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.category = :val')
            ->setParameter('val', $value)
            ->orderBy('r.Name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findallPublished()
    {
        return $this->createQueryBuilder('r')
            ->select('r','i','t','ing')
            ->join('r.ingredients','ing')
            ->join('r.directions','t')
            ->join('r.image', 'i')
            ->orderBy('r.createdDate', 'DESC')
            ->getQuery()
            ->getResult();
    }


    public function findbar($data){
        return $this->createQueryBuilder('r')
            ->andWhere('r.Name= : val')
            ->setParameter('val' ,'%'.$data. '%')
            ->orderBy('r.createdDate','DESC')
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Recipe
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
