<?php

namespace AppBundle\Repository;

use AppBundle\Repository\RepositoryBase;

/**
 * MatchRepository
 */
class MatchRepository extends RepositoryBase {

    public function findAvailable($limit = 0) {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder('t');

        $qb->select('t')
            ->from('AppBundle:Match', 't')
            ->where($qb->expr()->gt('t.date', 'CURRENT_DATE()'))
            ->orderBy('t.date', 'ASC');

        if($limit > 0) {
            $qb->setMaxResults($limit);
        }

        $query = $qb->getQuery();

        return $query->getResult();
    }

}
