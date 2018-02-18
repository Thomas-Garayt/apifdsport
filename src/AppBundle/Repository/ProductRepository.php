<?php

namespace AppBundle\Repository;

use AppBundle\Repository\RepositoryBase;

/**
 * ProductRepository
 */
class ProductRepository extends RepositoryBase {

    public function findNewest($limit = 0) {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder('p');

        $qb->select('p')
            ->from('AppBundle:Product', 'p')
            ->orderBy('p.id', 'DESC');


        if($limit > 0) {
            $qb->setMaxResults($limit);
        }

        $query = $qb->getQuery();

        return $query->getResult();
    }

}
