<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostServiceInterface as PostService;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;

class PostController extends Controller
{   

    protected $postService;
    protected $postRepository;
    protected $categoryRepository;

    public function __construct(PostService $postService, PostRepository $postRepository, CategoryRepository $categoryRepository)
    {
        $this->postService = $postService;
        $this->postRepository = $postRepository;
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Blog: Bài đăng';
        $data['content'] = 'post.index';

        $data['posts'] = $this->postService->index();

        return view('backend.tabler.layout', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Blog: Thêm mới';
        $data['content'] = 'post.create';

        $data['categories'] = $this->categoryRepository->all();

        return view('backend.tabler.layout', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required',
            'slug'  => 'required',
            'content'  => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Handle the file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $path = '/images/' . $imageName;
        }
        $dataUpd = [
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'category_id' => $request->category ?? null,
            'summary' => $request->description ?? null,
            'tags' => $request->tags ?? null,
            'image' => $path ?? null,
        ];
        
        $dataUpd = array_filter($dataUpd, function($value) {
            return !is_null($value);
        });

        $this->postRepository->create($dataUpd);
        
        return redirect()->route('admin.post.index')->with('success', 'Thêm mới bài viết thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $data['title'] = 'Blog: Chỉnh sửa';
        $data['content'] = 'post.edit';

        $data['post'] = $this->postRepository->findById($id, ['*'], ['category']);
        $data['categories'] = $this->categoryRepository->all();

        return view('backend.tabler.layout', compact('data'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $path = '/images/' . $imageName;
        }
        $dataUpd = [
            'title' => $request->title,
            'slug' => $request->slug,
            'summary' => $request->description,
            'content' => $request->content,
            'category_id' => $request->category,
            'tags' => $request->tags,
        ];
        if (isset($path)) {
            $dataUpd['image'] = $path;
        }

        $this->postRepository->update($id, $dataUpd);
        
        return redirect()->route('admin.post.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
