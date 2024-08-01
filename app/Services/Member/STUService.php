<?php

namespace App\Services\Member;
use Illuminate\Support\Facades\DB;

use App\Services\Member\Interfaces\STUServiceInterface;
use App\Repositories\Interfaces\STURepositoryInterface as STURepository;
/**
 * Class STUService
 * @package App\Services
 */
class STUService implements STUServiceInterface
{
    protected $STURepository;

    public function __construct(STURepository $STURepository)
    {
        $this->STURepository = $STURepository;
    }
    public function index($request)
    {
        $user = $request->user();

        $keyword = addslashes($request->input('keyword'));
        $created_at = addslashes($request->input('created_at'));
        $level = addslashes($request->input('level'));

        $condition['where'] = [['user_id', '=', $user->id], ['status', '=', 1]];
        if (!empty($created_at)) {
            $condition['where'][] = [DB::raw('date(created_at)'), '=', $created_at];
        }
        if (!empty($keyword)) {
            $condition['where'][] = ['alias', 'LIKE', ('%'.$keyword.'%')];
        }
        if (!empty($level) && $level != -1) {
            $condition['where'][] = ['level_id', '=', $level];
        }
        
        $links = $this->STURepository->pagination(['*'], $condition);

        return $links;
    }
}
