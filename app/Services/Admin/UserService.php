<?php

namespace App\Services\Admin;

use App\Services\Admin\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class UserService
 * @package App\Services\Admin
 */
class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository = null) {
        $this->userRepository = $userRepository;
    }

    public function index($request)
    {
        $keyword = addslashes($request->input('keyword'));
        $created_at = addslashes($request->input('created_at'));
        $role = addslashes($request->input('role'));
        $orderByCol = $request->input('order_by_col') && $request->input('order_by_col') != '-1' ? $request->input('order_by_col') : 'id';
        $orderByMethod = $request->input('order_by_method') ? $request->input('order_by_method') : 'desc';

        $condition = [
            'keyword' => $keyword,
            'orWhere' => [
                ['email', 'LIKE', ('%'.$keyword.'%')],
                ['users.id', 'LIKE', ('%'.$keyword.'%')]
            ],
        ];
        if (!empty($created_at)) {
            $condition['whereRaw'] = [['date(created_at) = '. $created_at]];
        }

        $invoices = $this->userRepository->pagination(
            ['*'],
            $condition,
            10,
            [],
            [$orderByCol, $orderByMethod],
            );
        return $invoices;
    }

    public function show($request, $id)
    {
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');
        $currentPage = $request->query('p_sats', 1);
        $perPage = 10;
        $offset = ($currentPage - 1) * $perPage;

        if (!$startDate || !$endDate) {
            $startDate = Carbon::now()->firstOfMonth();
            $endDate = Carbon::now();
        } else {
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();
        }

        $user = $this->userRepository->findById($id, ['*'], ['withdraw', 'STUstats']);
        $metric = [
            'total_pending' => $user->withdraw->where('status', 'pending')->sum('amount'),
            'total_approved' => $user->withdraw->where('status', 'approved')->sum('amount'),
            'total_completed' => $user->withdraw->where('status', 'completed')->sum('amount'),
            'total_cancelled' => $user->withdraw->where('status', 'cancelled')->sum('amount'),
            'total_hold' => $user->withdraw->where('status', 'hold')->sum('amount'),
            'total_revenue' => $user->STUstats->sum('revenue'),
            'total_views' => $user->STUstats->sum('clicks'),
        ];
        $metric['total_balance'] = $metric['total_revenue'] - $metric['total_pending'] - $metric['total_approved'] - $metric['total_completed'] - $metric['total_hold'];

        $STUstats = $user->STUstats;
        $ctSTUstats = $STUstats->where('date', '>=', $startDate)->where('date', '<=', $endDate);
        $withdraw = $user->withdraw;
        $ctWithdraw = $withdraw->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate);
        $STUlinks = $user->STUlinks;
        $ctSTUlinks = $STUlinks->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate);

        $yourDataArray = convertPaginData($ctSTUstats, $startDate, $endDate);
        $items = array_slice($yourDataArray, $offset, $perPage);
        $total = count($yourDataArray);
        
        return [
            'user' => $user,
            'user_metric' => $metric,
            'STUstats' => $STUstats,
            'ctSTUstats' => $ctSTUstats,
            'withdraw' => $withdraw,
            'ctWithdraw' => $ctWithdraw,
            'STUlinks' => $STUlinks,
            'ctSTUlinks' => $ctSTUlinks->sortByDesc('created_at'),
            'ctStatsTable' => new LengthAwarePaginator($items, $total, $perPage, $currentPage, [
                'path' => url()->current(),
                'pageName' => 'p_sats', 
            ]),
        ];
    }

}
