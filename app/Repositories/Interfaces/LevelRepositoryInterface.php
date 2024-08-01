<?php

namespace App\Repositories\Interfaces;
use App\Repositories\Interfaces\BaseRepositoryInterface;
/**
 * Interface LevelRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface LevelRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
    public function pubLevel();
}
