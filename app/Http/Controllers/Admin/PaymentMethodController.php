<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PaymentMethodRepositoryInterface as PaymentMethodRepository;

class PaymentMethodController extends Controller
{
    protected $paymentMethodRepository;

    public function __construct(PaymentMethodRepository $paymentMethodRepository = null) {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $methods = $this->paymentMethodRepository->getPaginate();

        $data = ['methods' => $methods, 'title' => 'Phương thức thanh toán', 'content' => 'payment-method.index'];
        
        return view('backend.tabler.layout', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Thêm mới phương thức',
            'content' => 'payment-method.create',
        ];
        return view('backend.tabler.layout', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
            'fee' => 'required',
            'minimum' => 'required'

        ]);

        $this->paymentMethodRepository->create([
            'name' => $request->name,
            'description' => $request->description,
            'fee' => $request->fee,
            'minimum' => $request->minimum,
        ]);

        return redirect(route('admin.payment-methods.index'))->with('success', 'Phương thức <b>'.$request->name.'</b>đã được tạo thành công!');
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
        $data['level'] = $this->paymentMethodRepository->findById($id);

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
