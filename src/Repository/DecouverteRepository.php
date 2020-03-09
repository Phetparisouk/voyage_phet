<?php

namespace App\Repository;

use App\Entity\Decouverte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Decouverte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Decouverte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Decouverte[]    findAll()
 * @method Decouverte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DecouverteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Decouverte::class);
    }

    public function test():Query
    {
        $results = $this->createQueryBuilder('decouverte')
        ->select('count(decouverte.name), continent.name')
        ->join('decouverte.continent', 'continent')
        ->groupby('decouverte.continent', 'continent')
        ->getQuery()
            /* ->select('product.name, product.price, category.name AS cName')
            ->join('product.category', 'category')
            ->where('product.price > :price')
            ->andWhere('product.name LIKE :name')
            ->setParameters([
                'price' => 500,
                'name' => '%ma%'
            ])
            ->getQuery()*/
        ;

        //retour de resultats
        return $results;
    }

    public function filter($filter): Query
    {
        $results = $this->createQueryBuilder('decouverte')
            ->join('decouverte.continent', 'continent')
            ->where('continent.id = :filter')
            ->setParameters([
                'filter' => $filter
            ])
            ->getQuery();
        return $results;
    }

    // /**
    //  * @return Decouverte[] Returns an array of Decouverte objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Decouverte
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
