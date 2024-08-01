<?php

namespace App\Services\Admin\Interfaces;

/**
 * Interface STUServiceInterface
 * @package App\Services\Interfaces
 */
interface STUServiceInterface
{
    public function index($request);
    public function show($request, string $id);
}
