<?php

namespace App\Services\Admin;
use Illuminate\Support\Facades\DB;

use App\Services\Admin\Interfaces\STUServiceInterface;
use App\Repositories\Interfaces\STURepositoryInterface as STURepository;
use App\Repositories\Interfaces\STUAccessRepositoryInterface as STUAccessRepository;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Carbon;

/**
 * Class STUService
 * @package App\Services
 */
class STUService implements STUServiceInterface
{
    protected $STURepository;
    protected $STUAccessRepository;

    public function __construct(STURepository $STURepository, STUAccessRepository $STUAccessRepository)
    {
        $this->STURepository = $STURepository;
        $this->STUAccessRepository = $STUAccessRepository;
    }
    public function index($request)
    {
        $user = $request->user();

        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['created_at'] = addslashes($request->input('created_at'));
        $condition['level'] = addslashes($request->input('level'));
        $condition['username'] = addslashes($request->input('username'));
    
        $perPage = 10;

        $links = $this->STURepository->getLinksByAdmin($condition, ['user', 'level'], ['id', 'DESC'], $perPage, '');

        return $links;
    }
    public function show($request, string $id)
    {
        $start = $request->query('start_date');
        $end = $request->query('end_date');
        $group_by = $request->query('group_by') ?? 'referral';
        $order_by = $request->query('order_by') ?? 'count';
        $order_method = $request->query('order_method') ?? 'desc';

        if(!isset($start) || !isset($end) || empty($start) || empty($end)) {
            $startDate = Carbon::now()->firstOfMonth();
            $endDate = Carbon::now();
        } else {
            $startDate = Carbon::parse($start)->startOfDay();
            $endDate = Carbon::parse($end)->endOfDay();
        }

        $sumReferral = $this->STUAccessRepository->sumAccessByCondition([['link_id', '=', $id], ['created_at', '>=', $startDate], ['created_at', '<=', $endDate]], 'count(referral) as sum');
        $referral = $this->STUAccessRepository->getAccessByCondition(
            [['link_id', '=', $id], ['created_at', '>=', $startDate], ['created_at', '<=', $endDate]],
            [$group_by.' as label', DB::raw('sum(revenue) as revenue'), DB::raw('count('.$group_by.') as count')],
            $group_by,
            [$order_by, $order_method]);
        $referral->sum = $sumReferral->sum;
        
        return [
            'referral' => $referral
        ];
    }
}
