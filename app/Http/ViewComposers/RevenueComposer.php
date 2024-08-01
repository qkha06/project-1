<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Services\Interfaces\WithdrawServiceInterface as WithdrawService;
use App\Repositories\Interfaces\UserRepositoryInterface as userRepository;
use App\Repositories\Interfaces\LevelRepositoryInterface as LevelRepository;
use App\Services\Interfaces\SettingServiceInterface as SettingService;

class RevenueComposer
{
    protected $revenueService;
    protected $statisticsService;
    protected $levelRepository;
    protected $userMetricRepository;
    protected $settingService;
    protected $userRepository;

    public function __construct (
        WithdrawService $revenueService,
        LevelRepository $levelRepository,
        SettingService $settingService,
        UserRepository $userRepository,
    ) {
        $this->revenueService = $revenueService;
        $this->levelRepository = $levelRepository;
        $this->settingService = $settingService;
        $this->userRepository = $userRepository;
    }

    public function compose(View $view)
    {
        $data = [
            '_levels' => $this->levelRepository->getByCondition([['status', '=', 1]]),
            '_settings' => $this->settingService->all()
        ];
        
        $view->with($data);
    }
}
