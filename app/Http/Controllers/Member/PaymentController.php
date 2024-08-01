<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\UserPayment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $user_payment = $user->payment;

        return view('backend.member.payment.index', compact('user_payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|numeric|max:2|regex:/^[a-zA-Z0-9\s]+$/',
            'payment_bank_name' => 'max:200',
            'payment_account_name' => 'required|max:200|regex:/^[a-zA-Z0-9\s]+$/',
            'payment_account_number' => 'required|max:100|regex:/^[a-zA-Z0-9\s]+$/',
        ], [
            'payment_method.regex' => 'Vui lòng nhập dữ liệu không dấu. Ví dụ: (NGUYEN VAN A)',
            'payment_bank_name.regex' => 'Vui lòng nhập dữ liệu không dấu. Ví dụ: (NGUYEN VAN A)',
            'payment_account_name.regex' => 'Vui lòng nhập dữ liệu không dấu. Ví dụ: (NGUYEN VAN A)',
            'payment_account_number.regex' => 'Vui lòng nhập dữ liệu không dấu. Ví dụ: (NGUYEN VAN A)',
        ]);

        $req_payment_method = $request->payment_method;

        if ($req_payment_method == 1) {
            $payment_method = 'momo';
        } else if ($req_payment_method == 2) {
            $payment_method = 'transfer';
        }

        $data = [
            'user_id' => $request->user()->id,
            'payment_method' => $payment_method,
            'payment_bank_name' => $request->payment_bank_name,
            'payment_account_name' => $request->payment_account_name,
            'payment_account_number' => $request->payment_account_number
        ];

        $dataPayment = UserPayment::where('user_id', $request->user()->id)->first();
        
        if ($dataPayment) {
            UserPayment::where('user_id', $request->user()->id)->update($data);
        } else {
            UserPayment::create($data);
        }

        return redirect()->back()->with('success', 'Cập nhật liên kết thành công');
    }
}
