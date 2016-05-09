<?php

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;

/**
 * BlogPostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BlogPostRepository extends EntityRepository
{
    public function findAllOrderedByDate()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT post FROM AppBundle:BlogPost post ORDER BY post.date DESC'
            )
            ->getResult();
    }

    public function findPostById($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT post FROM AppBundle:BlogPost post WHERE post.id = :id'
            )->setParameter('id', $id)->getResult();
    }
}
