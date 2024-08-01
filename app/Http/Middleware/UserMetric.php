<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\UserRepositoryInterface as userRepository;
use App\Repositories\Interfaces\WithdrawRepositoryInterface as withdrawRepository;
use Spatie\Permission\Models\Role;

class UserMetric
{
    protected $userRepository;
    protected $withdrawRepository;

    public function __construct (
        UserRepository $userRepository,
        WithdrawRepository $withdrawRepository
    ) {
        $this->userRepository = $userRepository;
        $this->withdrawRepository = $withdrawRepository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user) {
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
            $request->attributes->set('user_metric', $metric);
        }
        return $next($request);
    }
}
