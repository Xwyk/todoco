<?php

namespace App\Repository;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    /**
     * Return tasks for given user, and anonymous tasks if isAdmin is set to true.
     */
    public function findByUserState(User $user, bool $isAdmin = false, bool $finished = false): ?array
    {
        // Get tasks where author is user's id
        $queryBuilder = $this->createQueryBuilder('t')
            ->where('t.author = :author')
            ->setParameter('author', $user->getId());

        // If user is admin, add anonymous tasks to request
        if ($isAdmin) {
            $queryBuilder->orWhere('t.author IS NULL');
        }

        // Add state to request
        $queryBuilder
            ->andWhere('t.isDone = :state')
            ->setParameter('state', $finished);

        // Execute request and return result in array
        return $queryBuilder->getQuery()
            ->getResult();
    }
}
