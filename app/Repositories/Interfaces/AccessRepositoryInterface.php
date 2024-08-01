<?php

namespace App\Repositories\Interfaces;
use App\Repositories\Interfaces\BaseRepositoryInterface;
/**
 * Interface AccessRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface AccessRepositoryInterface extends BaseRepositoryInterface
{
    public function getStatsBetweenDates(
        $column = ['*'],
        array $date,
        $group,
        array $order = [],
        array $relation = []
    );
}
