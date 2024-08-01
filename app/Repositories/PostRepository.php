<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

/**
 * Class PostRepository.
 */
class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    protected $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }
    public function getPosts(
        int $take = null
        , int $paginate = null
        )
    {
        $query = $this->model->with('category', 'views')->where('status', 1);
        if ($take != null) {
            $query = $query->latest()->take($take);
        }
        if ($paginate != null) {
            $query = $query->latest()->paginate($paginate);
        } else {
            $query = $query->latest()->get();
        }
        return $query;
    }
    public function getPaginate($paginate = 10)
    {
        $query = $this->model->where('status', 1);
        if (isset($paginate) && !empty($paginate)) {
            $query = $query->paginate($paginate);
        } else {
            $query = $query->get();
        }
        return $query;
    }
    public function getPost($slug)
    {
        return $this->model->with('category')->where('slug', $slug)->firstOrFail();
    }
    public function getPostById($id)
    {
        return $this->model->findOrFail($id);
    }
    public function getPopularPosts(int $take = 5)
    {
        $query = $this->model->select('posts.*', DB::raw('COALESCE(SUM(post_views.views), 0) as views'))
        ->leftJoin('post_views', 'posts.id', '=', 'post_views.post_id')
        ->where('posts.status', 1)
        ->groupBy('posts.id')
        ->orderBy('views', 'DESC')
        ->take($take);

        return $query->get($take);
    }
    public function getPostsInRange(string $start, string $end)
    {
        return $this->model->skip($start)->take($end)->latest()->get();
    }
}
