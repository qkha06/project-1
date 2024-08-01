<?php

namespace App\Services\Admin\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Admin\Interfaces
 */
interface UserServiceInterface
{
    public function index($request);
    public function show($request, $id);
}
