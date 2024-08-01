<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseService
 * @package App\Services
 */
class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(
        Model $model
    ){
        $this->model = $model;
    }

    public function pagination(
        array $column = ['*'], 
        array $condition = [], 
        int $perPage = 10,
        array $extend = [],
        array $orderBy = ['id', 'DESC'],
        array $join = [],
        array $relations = [],
        array $rawQuery = []
        
    ){
        $query = $this->model->select($column);
        return $query  
                ->keyword($condition['keyword'] ?? null)
                ->publish($condition['publish'] ?? null)
                ->relationCount($relations ?? null)
                ->customWhere($condition['where'] ?? null)
                ->customOrWhere($condition['orWhere'] ?? null)
                ->customWhereRaw($rawQuery['whereRaw'] ?? null)
                ->customJoin($join ?? null)
                ->customGroupBy($extend['groupBy'] ?? null)
                ->customOrderBy($orderBy ?? null)
                ->paginate($perPage)
                ->withQueryString()->withPath(url()->current());
    }

    public function getPaginate () {
        return $this->model->paginate(10);
    }
    
    public function create(array $payload = []){
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    public function update(int $id = 0, array $payload = []){
       $model = $this->findById($id);
       return $model->update($payload);
    }
    public function updateOrInsert(array $attributes, array $values)
    {
        return $this->model->updateOrInsert($attributes, $values);
    }
    public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = []){
        return $this->model->whereIn($whereInField, $whereIn)->update($payload);
    }

    public function updateByWhere($condition = [], array $payload = []){
        $query = $this->model->newQuery();
        foreach($condition as $key => $val){
            $query->where($val[0], $val[1] , $val[2]);
        }
        return $query->update($payload);
    }
   

    public function delete(int $id = 0){
        return $this->findById($id)->delete();
    }

    public function forceDelete(int $id = 0){
        return $this->findById($id)->forceDelete();
    }

    public function forceDeleteByCondition(array $condition = []){
        $query = $this->model->newQuery();
        foreach($condition as $key => $val){
            $query->where($val[0], $val[1] , $val[2]);
        }
        return $query->forceDelete();
    }

    public function all(array $relation = []){
        return $this->model->with($relation)->get();
    }

    public function getAll() {
        return $this->model->All();
    }

    public function findById(
        int $modelId,
        array $column = ['*'],
        array $relation = []
    ){
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }

    public function findByCondition($condition = [], array $relation = []){
        $query = $this->model->with($relation)->newQuery();
        foreach($condition as $key => $val){
            $query->where($val[0], $val[1] , $val[2]);
        }
        return $query->first();
    }

    public function createPivot($model, array $payload = [], string $relation = ''){
        return $model->{$relation}()->attach($model->id, $payload);
    }
    
    public function getByCondition($condition = [], array $relation = [])
    {
        $query = $this->model->with($relation)->newQuery();
        foreach($condition as $key => $val){
            $query->where($val[0], $val[1] , $val[2]);
        }
        return $query->get();
    }
    public function firstOrNew(array $attributes, array $values = [])
    {
        return $this->model->firstOrNew($attributes, $values);
    }
    public function firstByCondition($condition = [], array $relation = [])
    {
        $query = $this->model->with($relation)->newQuery();
        foreach($condition as $key => $val){
            $query->where($val[0], $val[1] , $val[2]);
        }
        return $query->first();
    }

}
