<?php
namespace Clemac\PortfolioBundle\Entity;

use Doctrine\ORM\EntityRepository;

class VideoRepository extends EntityRepository
{
    public function countEntities()
    {
        return $this->createQueryBuilder('l')
                    ->select('COUNT(l)')
                    ->getQuery()
                    ->getSingleScalarResult();
    }
}