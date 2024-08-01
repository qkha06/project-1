<?php

namespace App\Repositories;

use App\Models\Level;
use App\Repositories\Interfaces\LevelRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class LevelRepository.
 */
class LevelRepository extends BaseRepository implements LevelRepositoryInterface
{
    protected $model;

    public function __construct(Level $model)
    {
        $this->model = $model;
    }
    public function pubLevel()
    {
       return $this->model->where('status', 1)->get();
    }
}
