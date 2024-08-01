<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;
use App\Repositories\Interfaces\LevelRepositoryInterface as LevelRepository;

class LevelController extends Controller
{
    protected $levelRepository;

    public function __construct(LevelRepository $levelRepository = null) {
        $this->levelRepository = $levelRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = Level::all();
        $data = ['levels' => $levels, 'title' => 'Cấp độ', 'content' => 'level.index'];
        return view('backend.tabler.layout', compact('data'));

        // $data = ['levels' => $levels, 'title' => 'Cấp độ', 'content' => 'levels.index'];
        // return view('backend.admin.layout', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tạo cấp độ',
            'content' => 'levels.create',
        ];
        return view('backend.admin.basic-layout', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cpm' => 'required',
            'limit' => 'required',
        ]);

        $user = Level::create([
                    'name' => $request->name,
                    'click_limit' => $request->cpm.','.$request->limit,
                    'click_value' => $request->cpm.','.$request->limit,
                    'test_link' => $request->cpm.','.$request->limit,
                    'description' => $request->description
                ]);

        return redirect(route('admin.level.index'))->with('success', 'Cấp độ <b>'.$request->name.'</b>đã được tạo thành công!');
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
    public function edit(string $id)
    {
        $data['title'] = 'Chỉnh sửa cấp độ';
        $data['content'] = 'level.edit';
        $data['level'] = $this->levelRepository->findById($id);

        return view('backend.tabler.layout', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'click_limit' => 'required',
            'click_value' => 'required',
            'status' => 'required',
            'redirect_url' => 'required',
        ]);

        $user = Level::where('id', $id)->update([
                    'name' => $request->name,
                    'click_limit' => $request->click_limit,
                    'click_value' => $request->click_value,
                    'test_link' => $request->test_link,
                    'status' => $request->status,
                    'description' => $request->description ?? '',
                    'redirect_url' => $request->redirect_url,
                ]);

        return redirect(route('admin.level.index'))->with('success', 'Cấp độ <b>'.$request->name.'</b> cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function editConfig(string $id)
    {
        $lvData = Level::find($id);
        $data = ['lvData' => json_decode($lvData), 'title' => 'Cấu hình cấu độ', 'content' => 'level.config'];
        return view('backend.tabler.layout', compact('data'));
    }
    public function updateConfig(Request $request, string $id)
    {
        $updated = Level::where('id', $id)->update([
            'config' => json_encode($request->data)
        ]);
        if ($updated) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Không thể cập nhật cấu hình'], 500);
        }
    }
}
