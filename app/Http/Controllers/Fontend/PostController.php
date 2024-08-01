<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Services\Interfaces\BlogServiceInterface as BlogService;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;

class PostController extends Controller
{
    protected $blogService;
    protected $postRepository;
    protected $categoryRepository;

    public function __construct(BlogService $blogService, PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $this->blogService = $blogService;
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function show($slug) {
        $this->blogService->show($slug);
        $article = $this->postRepository->findByCondition([['slug', '=', $slug]]);
        if (empty($article)) {
            return abort(404);
        }
        $data['title'] = $article->title;
        $data['description'] = $article->summary;
        $data['keywords'] = 'Key word';
        $data['seo_meta'] = '';
        $data['content'] = 'article';
        $article_data = $article;
        $related_articles = $this->postRepository->getByCondition([['category_id', '=', $article->category_id]]);

        return view('fontend.blog.post', compact('article_data', 'related_articles'));
    }
}
