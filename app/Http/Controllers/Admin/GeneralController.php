<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\SettingServiceInterface as SettingService;

class GeneralController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService) {
        $this->settingService = $settingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Thiết lập liên kết';
        $data['content'] = 'system.index';
        return view('backend.tabler.layout', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {   
        $request->validate([
            'web_name' => 'required|string|max:255',
            'web_url' => 'required|url',
            'web_status' => 'nullable|string',
            'stu_url' => 'required|url',
            'stu_length' => 'nullable|integer',
            'stu_decode' => 'nullable|string',
            'note_decode' => 'nullable|string',
            'web_favicon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'web_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $web_f = $this->uploadImg($request, 'web_favicon');
        $web_i = $this->uploadImg($request, 'web_image');

        $param = $request->except('_token', 'web_favicon', 'web_image');

        if (!empty($web_f)) {
            $param['web_favicon'] = $web_f;
        }
        if (!empty($web_i)) {
            $param['web_image'] = $web_i;
        }

        foreach ($param as $key=>$val) {
            if (!empty($val)) {
                $this->settingService->set($key, $val);
            }
        }
        // return redirect()->route('admin.general.index')->withInput();
        return redirect()->route('admin.general.index')->withInput()->with('success', 'Cập nhật thành công!');
    }

    private function uploadImg($request, $name)
    {
        if ($request->hasFile($name)) {
            $image = $request->file($name);
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $path = '/images/' . $imageName;

            return $path;
        } else {
            return false;
        }
    }
}
