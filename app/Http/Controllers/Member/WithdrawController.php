<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\WithdrawRepositoryInterface as WithdrawRepository;
use App\Notifications\WithdrawNotification;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\Mail;

class WithdrawController extends Controller
{
    protected $withdrawRepository;
    protected $userRepository;

    public function __construct(WithdrawRepository $withdrawRepository, UserRepository $userRepository) {
        $this->withdrawRepository = $withdrawRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $__withdraw = $this->withdrawRepository->pagination();
    
        return view('backend.member.withdraw.index', compact('__withdraw'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
  
        $request->validate([
            'amount' => 'required',
        ]);

        $amount = $request->amount;
        $type = $request->input('type') == 'fast' ? 1 : 0;
        $costs = $type === 1 ? 10 : 0;
        $validAmounts = array(3, 5, 10, 20, 30, 50, 80, 100, 500, 800, 1000, 2000, 5000, 8000);
        if (!in_array($request->amount, $validAmounts)) {
            return redirect()->back()->withErrors('Giá trị không hợp lệ');
        }

        $user_metric = $request->attributes->get('user_metric');
        $balance = $user_metric['total_balance'];
        if ($amount > $balance) {
            return redirect()->back()->withErrors('Số dư không đủ, cày cuốc mạnh lên đi nào :3');
        }

        $user = $request->user();

        $dataPmt = $user->payment()->first();

        if ($dataPmt) {
            $data = [
                'amount' => $request->amount,
                'costs' => $costs,
                'type' => $type,
                'user_id' => $user->id,
                'payment_method' => $dataPmt->payment_method,
                'payment_account_number' => $dataPmt->payment_account_number,
                'payment_account_name' => $dataPmt->payment_account_name,
                'payment_bank_name' => $dataPmt->payment_bank_name
            ];
            $withdraw = $this->withdrawRepository->create($data);
            $messageTlg = 'Yêu cầu thanh toán mới!' . "\n" . 
            '- Số tiền: $' . $request->amount . "\n" . 
            '- Phí rút: $' . ($costs * $request->amount / 100) . ' (' . ($costs * $request->amount / 100) * 22000 . ' vnđ)' . "\n" .
            '- Kiểu rút: *' . ($type == 1 ? 'NHANH' : 'CHẬM') . '*';
            $admin = $this->userRepository->findById(2);

            $templateMailAdmin = [
                'subject' => '[Link4Sub] Có yêu cầu rút tiền mới #'.$withdraw->id,
                'greeting' => 'Xin chào, ' . $admin->name . '!',
                'body' => '
                    <p>Có một đơn rút mới, cần bạn xử lý..!</p>
                    <p>- ID: '.$withdraw->id.'</p>
                    <p>- Người yêu cầu rút: '.$withdraw->user->name.'</p>
                    <p>- Số tiền: $'.$withdraw->amount.'</p>
                    <p>- Kiểu rút: '.($withdraw->type == 1 ? 'Nhanh' : 'Bình thường').'</p>
                    <p>- Ngày rút: '.$withdraw->created_at.'</p>
                    <p>- Phương thức thanh toán: '.$withdraw->payment_method.'</p>
                    <p>- Tài khoản thanh toán: '.($withdraw->payment_method == 'momo' ? 'Momo' : $withdraw->payment_bank_name).' - '.$withdraw->payment_account_number.' - '.$withdraw->payment_account_name.'</p>
                    <p>Xem chi tiết tại <a href="'.url('/admin/invoices/').'" target="_blank">đây</a>.</p>
                    <p>Trân trọng!</p>
                '
            ];
            $templateMailMember = [
                'subject' => '[Link4Sub] Yêu cầu rút tiền của bạn đang được xử lý',
                'greeting' => 'Xin chào, ' .$withdraw->user->name. '!',
                'body' => '
                    <p>Chúng tôi đã nhận được yêu cầu rút tiền của bạn.</p>
                    <p>- ID: '.$withdraw->id.'</p>
                    <p>- Số tiền: $'.$withdraw->amount.'</p>
                    <p>- Kiểu rút: '.($withdraw->type == 1 ? 'Nhanh' : 'Bình thường').'</p>
                    <p>- Ngày rút: '.$withdraw->created_at.'</p>
                    <p>- Phương thức thanh toán: '.$withdraw->payment_method.'</p>
                    <p>- Tài khoản thanh toán: '.($withdraw->payment_method == 'momo' ? 'Momo' : $withdraw->payment_bank_name).' - '.$withdraw->payment_account_number.' - '.$withdraw->payment_account_name.'</p>
                    <p>Link4Sub đang tiến hành xử lý yêu cầu của bạn.</p>
                    <p>Trân trọng,</p>
                    <p>Link4Sub</p>
                '
            ];

            Mail::to($admin->email)->queue(new WithdrawNotification($templateMailAdmin));
            Mail::to($withdraw->user->email)->queue(new WithdrawNotification($templateMailMember));

            return redirect()->back()->with('success', 'Đơn rút ($'.$request->amount.') của bạn đang được xử lý.');
        }

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
