<?php

namespace App\Repository;

use App\Entity\Reserva;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Reserva|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reserva|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reserva[]    findAll()
 * @method Reserva[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Reserva[]    cochesPorfechas(string $f1, string $f2)
 */
class ReservaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reserva::class);
    }

    // /**
    //  * @return Reserva[] Returns an array of Reserva objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Reserva
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return Reserva[]
     */
    public function cochesPorfechas(string $f1, string $f2): array
    {
        $entityManager = $this->getEntityManager();
        $f1 =  str_replace("-", "/", $f1);
        $f2 =  str_replace("-", "/", $f2);

        $query = $entityManager->createQuery(
            "SELECT distinct(r.coche)
            FROM App\Entity\Reserva r
            WHERE ('".$f1."' <= r.Fechaini and '".$f2."'>=r.Fechafin) or 
            ('".$f1."'<=r.Fechaini and '".$f2."'>=r.Fechaini and '".$f2."'<=r.Fechafin) or 
            ('".$f1."'>=r.Fechaini and '".$f1."'<=r.Fechafin and '".$f2."'>=r.Fechafin)"
        );
        
        // returns an array of Product objects
        return $query->getResult();
    }

    public function insertaReserva($array, EntityManagerInterface $entityManager){
        
        $fechaini = new DateTime($array[0]);
        $fechafin = new DateTime($array[1]);
        $reserva= new Reserva();
        $reserva->setFechaini(
            $fechaini
        );
        $reserva->setFechafin(
            $fechafin
        );
        $reserva->setOficinaRecogida(
            $array[2]
        );
        $reserva->setOficinadevolucion(
            $array[3]
        );
        $reserva->setPrecioTotal(
            $array[4]
        );
        $reserva->setCoche(
            $array[5]
        );
        $reserva->setUsuario(
            $array[6]
        );

        $entityManager->persist($reserva);
        $entityManager->flush();
          
    }
    
}
