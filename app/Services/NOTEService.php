<?php

namespace App\Services;

use App\Services\Interfaces\NOTEServiceInterface;
use App\Repositories\Interfaces\NOTERepositoryInterface as NOTERepository;
use Illuminate\Support\Facades\DB;

/**
 * Class NOTEService
 * @package App\Services
 */
class NOTEService implements NOTEServiceInterface
{
    protected $NOTERepository;

    public function __construct(NOTERepository $NOTERepository)
    {
        $this->NOTERepository = $NOTERepository;
    }
    public function index($request)
    {
        $user = $request->user();

        $keyword = addslashes($request->input('keyword'));
        $created_at = addslashes($request->input('created_at'));
        $level = addslashes($request->input('level'));

        $condition['where'] = [['user_id', '=', $user->id]];
        if (!empty($created_at)) {
            $condition['where'][] = [DB::raw('date(created_at)'), '=', $created_at];
        }
        if (!empty($keyword)) {
            $condition['where'][] = ['alias', 'LIKE', ('%'.$keyword.'%')];
            $condition['orWhere'][] = ['title', 'LIKE', ('%'.$keyword.'%')];
            $condition['orWhere'][] = ['content', 'LIKE', ('%'.$keyword.'%')];
        }
        if (!empty($level) && $level != -1) {
            $condition['where'][] = ['level_id', '=', $level];
        }
        
        $links = $this->NOTERepository->pagination(['*'], $condition);

        return $links;
    }
}
