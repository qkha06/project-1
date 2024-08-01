<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
/**
 * Class CategoryRepository.
 */
class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
  
     protected $model;

     public function __construct(Category $model)
     {
         $this->model = $model;
     }
     public function getPaginate($paginate = 10)
     {
         $query = $this->model;
         if (isset($paginate) && !empty($paginate)) {
             $query = $query->paginate($paginate);
         } else {
             $query = $query->get();
         }
         return $query;
     }
}
