<?php

namespace App\Repository;

use App\Entity\Coche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Coche|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coche|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coche[]    findAll()
 * @method Coche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CocheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coche::class);
    }

    // /**
    //  * @return Coche[] Returns an array of Coche objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Coche
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return Coche[]
     */
    public function cochesNoReservados(string $cadena): array
    {
        $entityManager = $this->getEntityManager();


        $query = $entityManager->createQuery(
            "SELECT c
            FROM App\Entity\Coche c
            WHERE c.id not in (".$cadena.")"
        );
        
        // returns an array of Product objects
        return $query->getResult();
    }

    /**
     * @return Coche[]
     */
    public function cochesFiltrados(string $cadena, string $marca, string $precio): array
    {
        $entityManager = $this->getEntityManager();

        if($marca=="vacio" && $precio=="50-100")
        {
            $query = $entityManager->createQuery(
                "SELECT c
                FROM App\Entity\Coche c
                WHERE c.id not in (".$cadena.") and c.precio<100"
            );
        }
        if($marca=="vacio" && $precio=="100-150"){
            $query = $entityManager->createQuery(
                "SELECT c
                FROM App\Entity\Coche c
                WHERE c.id not in (".$cadena.") and (c.precio>100 and c.precio<150)"
            );
        }
        if($marca=="vacio" && $precio=="150-200"){
            $query = $entityManager->createQuery(
                "SELECT c
                FROM App\Entity\Coche c
                WHERE c.id not in (".$cadena.") and (c.precio>150 and c.precio<200)"
            );
        }
        if($marca!="vacio" && $precio=="50-100"){
            $query = $entityManager->createQuery(
                "SELECT c
                FROM App\Entity\Coche c
                WHERE c.id not in (".$cadena.") and c.precio<100 and c.marca=".$marca
            );
        }
        if($marca!="vacio" && $precio=="100-150"){
            $query = $entityManager->createQuery(
                "SELECT c
                FROM App\Entity\Coche c
                WHERE c.id not in (".$cadena.") and (c.precio>100 and c.precio<150) and c.marca=".$marca
            );
        }
        if($marca!="vacio" && $precio=="100-150"){
            $query = $entityManager->createQuery(
                "SELECT c
                FROM App\Entity\Coche c
                WHERE c.id not in (".$cadena.") and (c.precio>150 and c.precio<200) and c.marca=".$marca
            );
        }
        
        // returns an array of Product objects
        return $query->getResult();
    }
}
