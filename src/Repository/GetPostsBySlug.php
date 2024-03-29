<?php

namespace App\Repository;

use App\Entity\Post;
use App\Exception\MultiplePostsFound;
use App\Exception\PostNotFound;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[] findAll()
 * @method Post[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GetPostsBySlug extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * @throws MultiplePostsFound
     * @throws PostNotFound
     */
    public function __invoke(string $slug): ?Post
    {
        try {
            $post = $this->createQueryBuilder('posts')
                ->select('posts')
                ->leftJoin('posts.oldSlug', 'oldSlug')
                ->where('oldSlug.oldSlug = :slug')
                ->orWhere('posts.slug = :slug')
                ->setParameter('slug', $slug)
                ->getQuery()->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            throw new MultiplePostsFound($e);
        }

        if (null === $post) {
            throw new PostNotFound();
        }

        return $post;
    }
}
