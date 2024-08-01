<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\STUStatisticRepositoryInterface;

use App\Models\StuLinkClick as STUStatistic;
use Illuminate\Support\Facades\DB;


/**
 * Class STUStatisticRepository.
 */
class STUStatisticRepository extends BaseRepository implements STUStatisticRepositoryInterface
{
    protected $model;

    public function __construct(STUStatistic $model) {
        $this->model = $model;
    }
    /**
     * @return string
     *  Return the model
     */
    
    public function getStatsBetweenDates($startDate, $endDate)
    {
        $query = DB::table('stu_link_clicks as sc')
        ->select(DB::raw('DATE(sc.date) as date'), DB::raw('SUM(sc.clicks) as clicks'), DB::raw('SUM(sc.revenue) as revenue'))
        ->join('stu_links as sl', 'sc.link_id', '=', 'sl.id')->whereDate('date', '>=', $startDate)
        ->whereDate('date', '<=', $endDate)
        ->groupBy(DB::raw('DATE(sc.date)'))
        ->orderBy('date', 'asc')
        ->get();
        return $query;
    }
    public function updateOrInsertStatsByAttr(array $attrs = [], $click_value = 0)
    {
        $check = $this->model->firstOrNew($attrs);

        if (!$check->exists) {
            $check->clicks = 1;
            $check->revenue = $click_value;
            $check->save();
        } else {
            $check->increment('clicks');
            $check->increment('revenue', $click_value);
        }
    }

    public function getLinks(
        $user_id=null
      , array $condition = []
      , $PATH
  )
  {
      $query = DB::table('users')
          ->join('note_links', 'users.id', '=', 'note_links.user_id')
          ->leftJoin('note_link_clicks', 'note_links.id', '=', 'note_link_clicks.link_id')
          ->select(
              'note_links.*',
              DB::raw('COALESCE(SUM(note_link_clicks.clicks), 0) AS click'),
              DB::raw('COALESCE(SUM(note_link_clicks.revenue), 0) AS income')
          )
          ->where('users.id', '=', $user_id)
          ->where('note_links.status', 1)
          ->where(function($query) use ($condition){
              if(isset($condition['keyword']) && !empty($condition['keyword'])){
                  $query->where('note_links.alias', 'LIKE', '%'.$condition['keyword'].'%')
                        ->orWhere('note_links.created_at', 'LIKE', '%'.$condition['keyword'].'%')
                        ->orWhere('note_links.title', 'LIKE', '%'.$condition['keyword'].'%');
              }
              if (isset($condition['created_at']) && !empty($condition['created_at'])){
                  $query->whereDate('note_links.created_at', $condition['created_at']);
              }
              if (isset($condition['level']) && !empty($condition['level']) && $condition['level'] != '-1'){
                  $query->where('note_links.level', $condition['level']);
              }
              return $query;
          })->groupBy('note_links.user_id', 'note_links.id', 'note_links.alias', 'note_links.title', 'note_links.content', 'note_links.password', 'note_links.level', 'note_links.created_at', 'note_links.updated_at', 'note_links.status')
          ->orderByDesc('note_links.created_at')
          ->paginate(10)->withQueryString()->withPath($PATH);
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
      $query = $this->model->select('note_links.*', DB::raw('COALESCE(SUM(note_link_clicks.clicks), 0) as total_clicks'), DB::raw('COALESCE(SUM(note_link_clicks.revenue), 0) as total_revenue'))
      ->with($relation)
      ->leftJoin('note_link_clicks', 'note_links.id', '=', 'note_link_clicks.link_id');
      if (isset($condition['username']) && !empty($condition['username'])) {
          $query->whereHas('user', function ($query) use ($condition) {
              $query->where('name', $condition['username']);
          });
      }
      $query->where(function($query) use ($condition){
          if(isset($condition['keyword']) && !empty($condition['keyword'])){
              $query->where('note_links.alias', 'LIKE', '%'.$condition['keyword'].'%')
                    ->orWhere('note_links.created_at', 'LIKE', '%'.$condition['keyword'].'%')
                    ->orWhere('note_link_clicks.revenue', 'LIKE', '%'.$condition['keyword'].'%');
          }
          if (isset($condition['created_at']) && !empty($condition['created_at'])){
              $query->whereDate('note_links.created_at', $condition['created_at']);
          }
          if (isset($condition['level']) && !empty($condition['level']) && $condition['level'] != '-1'){
              $query->where('note_links.level_id', $condition['level']);
          }
          return $query;
      });
      $query->groupBy('note_links.id')
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
      $query = $this->model->select('note_links.*', DB::raw('COALESCE(SUM(note_link_clicks.clicks), 0) as total_clicks'), DB::raw('COALESCE(SUM(note_link_clicks.revenue), 0) as total_revenue'))
      ->with($relation)
      ->leftJoin('note_link_clicks', 'note_links.id', '=', 'note_link_clicks.link_id')
      ->whereBetween('note_link_clicks.date', [$startDate, $endDate])
      ->groupBy('note_links.id')
      ->orderBy($orderBy[0], $orderBy[1]);
      
      return $query->paginate(10)->withQueryString()->withPath($path);
  }
}
