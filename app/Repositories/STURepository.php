<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\STURepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\StuLink;

/**
 * Class STURepository.
 */
class STURepository extends BaseRepository implements STURepositoryInterface
{
    protected $model;

    public function __construct(StuLink $model)
    {
        $this->model = $model;
    }
    public function getLinks(
          $user_id=0
        , array $condition = []
        , $PATH
    )
    {
        $query = DB::table('users')
            ->join('stu_links', 'users.id', '=', 'stu_links.user_id')
            ->leftJoin('stu_link_clicks', 'stu_links.id', '=', 'stu_link_clicks.link_id')
            ->leftJoin('levels', 'stu_links.level', '=', 'levels.id')
            ->select(
                'stu_links.*',
                'levels.name AS level_name',
                DB::raw('COALESCE(SUM(stu_link_clicks.clicks), 0) AS click'),
                DB::raw('COALESCE(SUM(stu_link_clicks.revenue), 0) AS income')
            )
            ->where('stu_links.status', 1);
            if($user_id != 0) {
                $query->where('users.id', $user_id);
            }
            $query->where(function($query) use ($condition){
                if(isset($condition['keyword']) && !empty($condition['keyword'])){
                    $query->where('stu_links.alias', 'LIKE', '%'.$condition['keyword'].'%')
                          ->orWhere('stu_links.created_at', 'LIKE', '%'.$condition['keyword'].'%')
                          ->orWhere('stu_link_clicks.revenue', 'LIKE', '%'.$condition['keyword'].'%');
                }
                if (isset($condition['created_at']) && !empty($condition['created_at'])){
                    $query->whereDate('stu_links.created_at', $condition['created_at']);
                }
                if (isset($condition['level']) && !empty($condition['level']) && $condition['level'] != '-1'){
                    $query->where('stu_links.level', $condition['level']);
                }
                return $query;
            })->groupBy('stu_links.user_id', 'stu_links.id', 'stu_links.alias', 'stu_links.data', 'stu_links.created_at', 'stu_links.updated_at', 'stu_links.status', 'stu_links.level')
            ->orderByDesc('stu_links.created_at')
            ->paginate(10)->withQueryString()->withPath(url()->current());

        return $query;
    }
    public function getLinksByAdmin(
        array $condition = [],
        array $relation = [],
        array $orderBy = ['id', 'DESC'],
        int $perPage = 10,
        string $path = '',
    )
    {
        $query = StuLink::select('stu_links.*', DB::raw('COALESCE(SUM(stu_link_clicks.clicks), 0) as total_clicks'), DB::raw('COALESCE(SUM(stu_link_clicks.revenue), 0) as total_revenue'))
        ->with($relation)
        ->leftJoin('stu_link_clicks', 'stu_links.id', '=', 'stu_link_clicks.link_id');
        if (isset($condition['username']) && !empty($condition['username'])) {
            $query->whereHas('user', function ($query) use ($condition) {
                $query->where('username', $condition['username']);
            });
        }
        $query->where(function($query) use ($condition){
            if(isset($condition['keyword']) && !empty($condition['keyword'])){
                $query->where('stu_links.alias', 'LIKE', '%'.$condition['keyword'].'%')
                      ->orWhere('stu_links.created_at', 'LIKE', '%'.$condition['keyword'].'%')
                      ->orWhere('stu_link_clicks.revenue', 'LIKE', '%'.$condition['keyword'].'%');
            }
            if (isset($condition['created_at']) && !empty($condition['created_at'])){
                $query->whereDate('stu_links.created_at', $condition['created_at']);
            }
            if (isset($condition['level']) && !empty($condition['level']) && $condition['level'] != '-1'){
                $query->where('stu_links.level', $condition['level']);
            }
            return $query;
        });
        $query->groupBy('stu_links.id')
        ->orderBy($orderBy[0], $orderBy[1]);
        
        return $query->paginate($perPage)->withQueryString()->withPath(url()->current());
    }
    public function getPopularBetween(
        $startDate,
        $endDate,
        array $relation = [],
        array $orderBy = ['id', 'DESC'],
        string $path,
    ){
        $query = StuLink::select('stu_links.*', DB::raw('COALESCE(SUM(stu_link_clicks.clicks), 0) as total_clicks'), DB::raw('COALESCE(SUM(stu_link_clicks.revenue), 0) as total_revenue'))
        ->with($relation)
        ->leftJoin('stu_link_clicks', 'stu_links.id', '=', 'stu_link_clicks.link_id')
        ->whereBetween('stu_link_clicks.date', [$startDate, $endDate])
        ->groupBy('stu_links.id')
        ->orderBy($orderBy[0], $orderBy[1]);
        
        return $query->paginate(10)->withQueryString()->withPath($path);
    }
}
