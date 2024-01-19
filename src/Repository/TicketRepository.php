<?php

namespace App\Repository;

use App\Entity\Lottery;
use App\Entity\Ticket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ticket>
 *
 * @method Ticket|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ticket|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ticket[]    findAll()
 * @method Ticket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ticket::class);
    }

    //    /**
    //     * @return Ticket[] Returns an array of Ticket objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Ticket
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    public function createTicketsOfLottery($stock, $lottery)
    {
        if ($stock <= 0) {
            return;
        }

        $cifras = strlen((string)$stock);
        $numeros = [];

        for ($i = 1; $i <= $stock; $i++) {
            $numeroConCeros = str_pad($i, $cifras, '0', STR_PAD_LEFT);
            $numeros[] = $numeroConCeros;
        }

        // Ahora $numeros contiene los números con ceros a la izquierda
        $numbers = [];
        foreach ($numeros as $numero) {
            $numbers[] = Ticket::create_empty($numero, $lottery);
        }
        return $numbers;
    }
}
