<?php

namespace App\Services;

use App\Services\Interfaces\DashboardServiceInterface;
use App\Repositories\Interfaces\NOTEStatisticRepositoryInterface as STUStatisticRepository;
use App\Repositories\Interfaces\WithdrawRepositoryInterface as WithdrawRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\STURepositoryInterface as STURepository;
use App\Repositories\Interfaces\NOTERepositoryInterface as NOTERepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class DashboardService
 * @package App\Services
 */
class DashboardService implements DashboardServiceInterface
{
    protected $STUStatisticRepository;
    protected $withdrawRepository;
    protected $userRepository;
    protected $STURepository;
    protected $NOTERepository;

    public function __construct(
        STUStatisticRepository $STUStatisticRepository,
        WithdrawRepository $withdrawRepository,
        UserRepository $userRepository,
        STURepository $STURepository,
        NOTERepository $NOTERepository)
    {
        $this->STUStatisticRepository = $STUStatisticRepository;
        $this->withdrawRepository = $withdrawRepository;
        $this->userRepository = $userRepository;
        $this->STURepository = $STURepository;
        $this->NOTERepository = $NOTERepository;
    }
    
    public function generate($request, $month, $year)
    {
        $user = $request->user();
        $monthPar = $month;
        $yearPar = $year;
    
        $join_at = strtotime($user->created_at);
        $currTime = time();
        $currentMonth = date('m');
        $currentYear = date('Y');
    
        if ($monthPar == $currentMonth && $yearPar == $currentYear) {
            $total_days = date('d');
        } elseif ($monthPar == 0 && $yearPar == 0) {
            $monthPar = date("m", $join_at);
            $yearPar = date("Y", $join_at);
            $total_days = floor((time() - $join_at) / (60 * 60 * 24));
        } else {
            $total_days = cal_days_in_month(CAL_GREGORIAN, $monthPar, $yearPar);
        }
    
        $options = [];
        while ($currTime >= $join_at) {
            $options[] = [
                'value' => "?month=" . date('m', $currTime) . "&year=" . date('Y', $currTime),
                'text' => date('m/Y', $currTime),
                'selected' => ($monthPar == date('n', $currTime) && $yearPar == date('Y', $currTime)),
            ];
            $currTime = strtotime('-1 month', $currTime);
        }

        $startDate = date('Y-m-01', strtotime("$year-$month-01"));
        $endDate = date('Y-m-t', strtotime($startDate));
        
        $report = $user->STUstats
                    ->where('date', '>=', $startDate)
                    ->where('date', '<=', $endDate)->groupBy('date');

        $total_clicks = 0;
        $total_revenue = 0;
        $_report = [];

        foreach ($report as $key=>$value) {
            $_report[$key] = [
                'date' => $key,
                'clicks' => $value->sum('clicks'),
                'revenue' => $value->sum('revenue')
            ];

            $total_clicks += $value->sum('clicks');
            $total_revenue += $value->sum('revenue');

        }
        
        $cpm = $total_clicks > 0 ? (($total_revenue / $total_clicks) * 1000) : 0;

        $total_revenue = round($total_revenue, 3);
        $cpm = round($cpm, 3);

        return [
            'report' => $_report,
            'total_clicks' => $total_clicks,
            'total_revenue' => $total_revenue,
            'cpm' => $cpm,
            'time' => [
                'total_days' => $total_days,
                'month' => $monthPar,
                'year' => $yearPar
            ],
            'options' => $options
        ];
    }
    public function adminIndex($request)
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

        $users = $this->userRepository->getByCondition([['created_at', '>=', $startDate], ['created_at', '<=', $endDate]]);
        $withdraws = $this->withdrawRepository->getByCondition([['created_at', '>=', $startDate], ['created_at', '<=', $endDate]]);

        $report = $this->STUStatisticRepository->getStatsBetweenDates($startDate, $endDate);
        
        $STU = $this->STURepository->getByCondition([['created_at', '>=', $startDate], ['created_at', '<=', $endDate]]);
        $NOTE = $this->NOTERepository->getByCondition([['created_at', '>=', $startDate], ['created_at', '<=', $endDate]]);
        
        $popular_STU = $this->STURepository->getPopularBetween($startDate, $endDate, ['user'], ['total_clicks', 'desc'], $request->url());
        
        $total_clicks = 0;
        $total_revenue = 0;

        foreach ($report as $key=>$value) {
            $total_clicks += $value->clicks;
            $total_revenue += $value->revenue;
        }

        $cpm = $total_clicks > 0 ? (($total_revenue / $total_clicks) * 1000) : 0;

        $total_revenue = round($total_revenue, 3);
        $cpm = round($cpm, 3);
        $data_chart = convertChartData($report, $startDate, $endDate);

        return [
            'report' => $report,
            'withdraws' => [
                'data' => $withdraws,
                'new' => [
                    'total' => $withdraws->count(),
                    'total_amount' => $withdraws->sum('amount'),
                ],
                'pending' => [
                    'total' => $withdraws->where('status', '=', 0)->count() + $withdraws->where('status', '=', 1)->count(),
                    'total_amount' => $withdraws->where('status', '=', 0)->sum('amount') + $withdraws->where('status', '=', 1)->sum('amount'),
                ],
                'successful' => [
                    'total' => $withdraws->where('status', '=', 2)->count(),
                    'total_amount' => $withdraws->where('status', '=', 2)->sum('amount'),
                ],
                'failed' => [
                    'total' => $withdraws->where('status', '=', 3)->count(),
                    'total_amount' => $withdraws->where('status', '=', 3)->sum('amount'),
                ],
            ],
            'users' => [
                'data' => $users,
                'new' => $users->count()
            ],
            'links' => [
                'stu' => [
                    'new' => $STU->count(),
                    'popular' => $popular_STU
                ],
                'note' => [
                    'data' => $NOTE,
                    'new' => $NOTE->count()
                ]
            ],
            'total_clicks' => $total_clicks,
            'total_revenue' => $total_revenue,
            'cpm' => $cpm,
            'date' => [
                'startDate' => $endDate,
                'endDate' => $endDate,
                'total_days' => calcDaysBetween($startDate, $endDate)
            ],
            'dataChart' => [
                'stats' => $data_chart
            ]
        ];
    }
}
