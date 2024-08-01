<?php

namespace App\Repositories\Interfaces;
use App\Repositories\Interfaces\BaseRepositoryInterface;
/**
 * Interface NOTERepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface NOTERepositoryInterface extends BaseRepositoryInterface
{
    public function getLinks(
        $user_id=null
      , array $condition = []
      , $PATH
    );
    public function getLinksByAdmin(
      array $condition = [],
      array $relation = [],
      array $orderBy = ['id', 'DESC'],
      int $perPage = 10,
      string $path,
    );
    public function getPopularBetween(
      $startDate,
      $endDate,
      array $relation = [],
      array $orderBy = ['id', 'DESC'],
      string $path,
    );
}
