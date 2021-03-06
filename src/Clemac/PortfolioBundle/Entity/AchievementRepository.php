<?php
namespace Clemac\PortfolioBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * AchievementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AchievementRepository extends EntityRepository
{
    public function countEntities()
    {
        return $this->createQueryBuilder('l')
                    ->select('COUNT(l)')
                    ->getQuery()
                    ->getSingleScalarResult();
    }
}
