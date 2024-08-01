<?php

namespace App\Services;

use App\Services\Interfaces\AccessServiceInterface;
use App\Repositories\Interfaces\AccessRepositoryInterface as AccessRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class AccessService
 * @package App\Services
 */
class AccessService implements AccessServiceInterface
{
    protected $accessRopitory;

    public function __construct(AccessRepository $accessRopitory) {
        $this->accessRopitory = $accessRopitory;
    }

    public function index($request)
    {
        $start = $request->query('startDate');
        $end = $request->query('endDate');

        if(!isset($start) || !isset($end) || empty($start) || empty($end)) {
            $startDate = Carbon::now()->firstOfMonth();
            $endDate = Carbon::now();
        } else {
            $startDate = Carbon::parse($request->query('startDate'))->startOfDay();
            $endDate = Carbon::parse($request->query('endDate'))->endOfDay();
        
        }
        $data = $this->accessRopitory->getStatsBetweenDates(
            'referral', [$startDate, $endDate], ['user_id', 'referral'], ['clicks', 'desc'], ['user']
        );

        // $data_chart = convertChartAccess($data);
        return $data;
    }
}
