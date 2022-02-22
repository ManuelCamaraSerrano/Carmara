<?php

namespace App\Repository;

use App\Entity\Marca;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Marca|null find($id, $lockMode = null, $lockVersion = null)
 * @method Marca|null findOneBy(array $criteria, array $orderBy = null)
 * @method Marca[]    findAll()
 * @method Marca[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarcaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Marca::class);
    }

    // /**
    //  * @return Marca[] Returns an array of Marca objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Marca
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @return Marca[]
     */
    public function marcas(string $f1, string $f2): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT r
            FROM App\Entity\Reserva r
            WHERE (:f1 <= fechaini and :f2>=fechafin) or 
            (:f1<=fechaini and :f2>=fechaini and :f2<=fechafin) or 
            (:f1>=fechaini and :f1<=fechafin and :f2>=fechafin)"
        )->setParameter('f1', $f1)
        ->setParameter('f2', $f2);

        // returns an array of Product objects
        return $query->getResult();
    }
}
