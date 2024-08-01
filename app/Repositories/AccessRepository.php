<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\AccessRepositoryInterface;

use App\Models\StuAnalysis;
use Illuminate\Support\Facades\DB;


/**
 * Class AccessRepository.
 */
class AccessRepository extends BaseRepository implements AccessRepositoryInterface
{
    protected $model;

    public function __construct(StuAnalysis $model) {
        $this->model = $model;
    }
    /**
     * @return string
     *  Return the model
     */
    public function getStatsBetweenDates(
        $column = ['*'],
        array $date,
        $group,
        array $order = [],
        array $relation = []
    ){
        $query = $this->model
        ->select('user_id', $column. ' as label')
        ->selectRaw('sum(revenue) as revenue')
        ->selectRaw('count(*) as clicks')
        ->whereDate('created_at', '>=', $date[0])
        ->whereDate('created_at', '<=', $date[1])
        ->with($relation)
        ->groupBy($group)
        ->orderBy($order[0], $order[1])
        ->paginate(10)->withQueryString()->withPath(url()->current());

        return $query;
    }

}
