<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\InvoiceServiceInterface as InvoiceService;
use App\Repositories\Interfaces\WithdrawRepositoryInterface as WithdrawRepository;
use Illuminate\Support\Facades\Mail;
use App\Notifications\WithdrawNotification;

class InvoiceController extends Controller
{
    protected $invoiceService;
    protected $withdrawRepository;

    public function __construct(InvoiceService $invoiceService, WithdrawRepository $withdrawRepository) {
        $this->invoiceService = $invoiceService;
        $this->withdrawRepository = $withdrawRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['title'] = 'Admin: Hoá đơn';
        $data['content'] = 'invoice.index';
        $data['invoices'] = $this->invoiceService->index($request);
        return view('backend.tabler.layout', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    public function pending(string $id)
    {
        $updatte = $this->withdrawRepository->update($id, [
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Đơn rút #'.$id.' đã chuyển thành trạng thái <b>pending</b>.');
    }
    public function watched(string $id)
    {
        $update = $this->withdrawRepository->update($id, [
            'status' => 'approved'
        ]);
        $withdraw = $this->withdrawRepository->findById($id);

        $templateMail = [
            'subject' => 'Lệnh rút #'.$withdraw->id.' đã được xem xét',
            'greeting' => 'Xin chào, ' .$withdraw->user->name. '!',
            'body' => '
                <p>Lệnh rút #'.$withdraw->id.' với số tiền $'.$withdraw->amount.' đã được xem xét. Hiện tại, bộ phận thanh toán của chúng tôi đang tiến hành thanh toán cho bạn.</p>
                <p>Chúc bạn một ngày tốt lành!</p>
                <p>Trân trọng,</p>
                <p>Link4Sub</p>
            '
        ];

        Mail::to($withdraw->user->email)->queue(new WithdrawNotification($templateMail));

        return redirect()->back()->with('success', 'Đơn rút #'.$id.' đã chuyển thành trạng thái <b>watched</b>.');
    }
    public function success(string $id)
    {
        $updatte = $this->withdrawRepository->update($id, [
            'status' => 'completed',
            'paid_at' => now()
        ]);
        $withdraw = $this->withdrawRepository->findById($id);

        $templateMail = [
            'subject' => 'Lệnh rút #'.$withdraw->id.' đã được thanh toán',
            'greeting' => 'Xin chào, ' .$withdraw->user->name. '!',
            'body' => '
                <p>Lệnh rút #'.$withdraw->id.' với số tiền $'.$withdraw->amount.' đã được thanh toán hoàn tất.</p>
                <p>Chúc bạn một ngày tốt lành!</p>
                <p>Trân trọng,</p>
                <p>Link4Sub</p>
            '
        ];

        Mail::to($withdraw->user->email)->queue(new WithdrawNotification($templateMail));
        return redirect()->back()->with('success', 'Đơn rút #'.$id.' đã chuyển thành trạng thái <b>success</b>.');
    }
    public function refuse(string $id)
    {
        $updatte = $this->withdrawRepository->update($id, [
            'status' => 'cancelled'
        ]);
        $withdraw = $this->withdrawRepository->findById($id);

        $templateMail = [
            'subject' => 'Lệnh rút #'.$withdraw->id.' đã bị từ chối',
            'greeting' => 'Xin chào, ' .$withdraw->user->name. '!',
            'body' => '
                <p>Lệnh rút #'.$withdraw->id.' với số tiền $'.$withdraw->amount.' không được chấp thuận, vui lòng liên hệ <a href="https://t.me/qckha06" target="_blank">Admin</a> để biết thêm thông tin chi tiết.</p>
                <p>Chúc bạn một ngày tốt lành!</p>
                <p>Trân trọng,</p>
                <p>Link4Sub</p>
            '
        ];

        Mail::to($withdraw->user->email)->queue(new WithdrawNotification($templateMail));
        return redirect()->back()->with('success', 'Đơn rút #'.$id.' đã chuyển thành trạng thái <b>refuse</b>.');
    }
    public function contact(string $id)
    {
        $updatte = $this->withdrawRepository->update($id, [
            'status' => 'hold'
        ]);
        $withdraw = $this->withdrawRepository->findById($id);

        $templateMail = [
            'subject' => 'Lệnh rút #'.$withdraw->id.' gặp một số vấn đề',
            'greeting' => 'Xin chào, ' .$withdraw->user->name. '!',
            'body' => '
                <p>Lệnh rút #'.$withdraw->id.' với số tiền $'.$withdraw->amount.' gặp một số vấn đề, vui lòng liên hệ <a href="https://t.me/qckha06" target="_blank">Admin</a> để biết thêm thông tin chi tiết.</p>
                <p>Chúc bạn một ngày tốt lành!</p>
                <p>Trân trọng,</p>
                <p>Link4Sub</p>
            '
        ];

        Mail::to($withdraw->user->email)->queue(new WithdrawNotification($templateMail));
        return redirect()->back()->with('success', 'Đơn rút #'.$id.' đã chuyển thành trạng thái <b>contact</b>.');
    }
}
