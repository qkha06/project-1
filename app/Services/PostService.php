<?php

namespace App\Services;

use App\Services\Interfaces\PostServiceInterface;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;

/**
 * Class PostService
 * @package App\Services
 */
class PostService implements PostServiceInterface
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $this->postRepository->getPaginate();
        return $this->postRepository->getPaginate();
    }
    public function edit(int $id)
    {
        return $this->postRepository->getPostById($id)->toArray();
    }
}
