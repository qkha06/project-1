<?php

namespace App\Repositories;

use App\Models\Level;
use App\Repositories\Interfaces\NOTELevelRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class NOTELevelRepository.
 */
class NOTELevelRepository extends BaseRepository implements NOTELevelRepositoryInterface
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
