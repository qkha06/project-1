<?php

namespace App\Repositories;

use App\Models\UserWithdraw as Withdraw;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\WithdrawRepositoryInterface;
use App\Repositories\BaseRepository;
/**
 * Class WithdrawReponsitory.
 */
class WithdrawRepository extends BaseRepository implements WithdrawRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    protected  $model;

    public function __construct(Withdraw $model)
    {
        $this->model = $model;
    }
    public function get($id)
    {
        return $this->model->select(
            DB::raw('SUM(CASE WHEN status = 0 THEN amount ELSE 0 END) as total_pending'),
            DB::raw('SUM(CASE WHEN status = 1 THEN amount ELSE 0 END) as total_watched'),
            DB::raw('SUM(CASE WHEN status = 2 THEN amount ELSE 0 END) as total_success'),
            DB::raw('SUM(CASE WHEN status = 3 THEN amount ELSE 0 END) as total_refuse'),
            DB::raw('SUM(CASE WHEN status = 4 THEN amount ELSE 0 END) as total_hold')
        )
        ->where('user_id', $id)
        ->first();
    }
}
