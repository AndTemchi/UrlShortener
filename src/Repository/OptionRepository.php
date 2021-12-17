<?php

namespace App\Repository;

use App\Entity\Option;
use App\Exception\NextIdNotFound;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Option|null find($id, $lockMode = null, $lockVersion = null)
 * @method Option|null findOneBy(array $criteria, array $orderBy = null)
 * @method Option[]    findAll()
 * @method Option[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Option::class);
    }

    public function incrementNextId(): void
    {
        $nextId = $this->findOneBy(['name' => 'next_id']);
        if (!$nextId) {
            throw new NextIdNotFound();
        }
        $this
            ->createQueryBuilder('n')
            ->update()
            ->set('n.value', (string)((int)$nextId->getValue() + 1))
            ->where('e.id = :id')
            ->setParameter('id', $nextId->getId())
            ->getQuery()
            ->execute();
    }
}
