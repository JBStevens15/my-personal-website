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

    public function findPostBySlug($slug)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT post FROM AppBundle:BlogPost post WHERE post.slug = :slug'
            )->setParameter('slug', $slug)->getResult();
    }
}
