<?php

namespace App\Repository;

use App\Entity\PedidoProductoCantidad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PedidoProductoCantidad|null find($id, $lockMode = null, $lockVersion = null)
 * @method PedidoProductoCantidad|null findOneBy(array $criteria, array $orderBy = null)
 * @method PedidoProductoCantidad[]    findAll()
 * @method PedidoProductoCantidad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PedidoProductoCantidadRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PedidoProductoCantidad::class);
    }

//    /**
//     * @return PedidoProductoCantidad[] Returns an array of PedidoProductoCantidad objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PedidoProductoCantidad
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
