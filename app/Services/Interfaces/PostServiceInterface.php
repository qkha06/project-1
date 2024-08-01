<?php

namespace App\Services\Interfaces;

/**
 * Interface PostServiceInterface
 * @package App\Services\Interfaces
 */
interface PostServiceInterface
{
    public function index();
    public function edit(int $id);
}
