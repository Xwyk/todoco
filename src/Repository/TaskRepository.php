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
     * Return tasks for given user, and anonymous tasks if isAdmin is set to true
     * @param User $user
     * @param bool $isAdmin
     * @return array|null
     */
    public function findByUser(User $user, bool $isAdmin = false): ?array{
        // Get tasks where author is user's id
        $queryBuilder = $this->createQueryBuilder('t')
            ->andWhere('t.author = :author')
            ->setParameter('val', $user->getId());

        // If user is admin, add anonymous tasks to request
        if ($isAdmin){
            $queryBuilder->andWhere('t.author IS NULL');
        }

        // Execute request and return result in array
        return $queryBuilder->getQuery()
            ->getResult();
    }
}
