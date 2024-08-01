<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Services\Interfaces\SettingServiceInterface as SettingService;

class SettingComposer
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function compose(View $view)
    {
        $st = $this->settingService->all();
        $_setting = [
            '_settings' => $st
        ];
        $view->with($_setting);
    }
}
