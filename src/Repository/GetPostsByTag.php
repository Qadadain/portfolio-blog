<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[] findAll()
 * @method Post[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GetPostsByTag extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function postByTag(int $identifier): mixed
    {
        return $this->createQueryBuilder('posts')
            ->select('posts')
            ->leftJoin('posts.tags', 'tags')
            ->andWhere('tags.identifier = :identifier')
            ->setParameter('identifier', $identifier)
            ->getQuery()->getResult();
    }
}
