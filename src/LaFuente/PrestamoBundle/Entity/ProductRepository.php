<?php

namespace LaFuente\PrestamoBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends EntityRepository
{
  public function count(){
    return $this->createQueryBuilder('p')
    ->select('count (p.id)')
    ->where('p.availability = :availability')
    ->setParameter('availability', true)
    ->getQuery()->getSingleScalarResult();
  }

  public function activos(){
    return $this->createQueryBuilder('p')
    ->select('p')
    ->where('p.availability = :availability')
    ->setParameter('availability', true)
    ->getQuery()->getResult();
  }

  public function randomId(){
    return $this->createQueryBuilder('p')
        ->select('p.id')
        ->where('p.availability = :availability')
        ->setParameter('availability', true)
        ->getQuery()->getSingleScalarResult();
  }

}
