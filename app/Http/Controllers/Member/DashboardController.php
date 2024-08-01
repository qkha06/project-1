<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use App\Notifications\TlgNotification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\UserWithdraw;
use App\Models\ApiToken;

use Illuminate\Support\Facades\Hash;
use App\Services\Interfaces\SettingServiceInterface as SettingService;


use App\Services\Interfaces\WithdrawServiceInterface as WithdrawService;
use App\Services\Interfaces\StatisticsServiceInterface as StatisticsService;
use App\Services\Interfaces\DashboardServiceInterface as DashboardService;


class DashboardController extends Controller
{
    protected $settingService;
    protected $revenueService;
    protected $statisticsService;
    protected $dashboardService;
    
    public function __construct(SettingService $settingService, WithdrawService $revenueService, StatisticsService $statisticsService, DashboardService $dashboardService)
    {
        $this->settingService = $settingService;
        $this->revenueService = $revenueService;
        $this->statisticsService = $statisticsService;
        $this->dashboardService = $dashboardService;
    }

    public function index(Request $request)
    {
        $get_month = $request->filled('month') && is_numeric(request('month')) && request('month') >= 1 && request('month') <= 12 ? request('month') : date('m');
        $get_year = $request->filled('year') && is_numeric(request('year')) && request('year') >= 1000 && request('year') <= 9999 ? request('year') : date('Y');
        $statistic = $this->dashboardService->generate($request, $get_month, $get_year);

        return view('backend.member.dashboard.index', compact('statistic'));
    }

    public function linkManagerStu(Request $request)
    {
        $user = $request->user();
        
        $results = DB::table('users')
            ->join('stu_links', 'users.id', '=', 'stu_links.user_id')
            ->leftJoin('stu_link_clicks', 'stu_links.id', '=', 'stu_link_clicks.link_id')
            ->select(
                'stu_links.*',
                DB::raw('COALESCE(SUM(stu_link_clicks.clicks), 0) AS click'),
                DB::raw('COALESCE(SUM(stu_link_clicks.revenue), 0) AS income')
            )
            ->where('users.id', $user->id)
            ->where('stu_links.status', 1)
            ->groupBy('stu_links.user_id', 'stu_links.id', 'stu_links.alias', 'stu_links.data', 'stu_links.created_at', 'stu_links.updated_at', 'stu_links.status', 'stu_links.level')
            ->paginate(10);

        $protocol = $request->secure() ? 'https' : 'http';
        $stu_short_url = empty($stu_domain) ? $request->url().'/' : $protocol.'://'.$stu_domain.'/';

        

        $data['title'] = 'Liên kết';
        $data['content'] = 'stu-links';

        $data['user_detail'] = $request->user();
        $data['user_stu_links'] = $results;
        $data['stu_short_url'] = $stu_short_url;

        return view('layouts.member.dashboard_layout', compact('data'));
    }
    
    public function linkManagerNote(Request $request)
    {
        $userId = $request->user()->id;
        $user = User::find($userId);
        
        $results = DB::table('users')
            ->join('note_links', 'users.id', '=', 'note_links.user_id')
            ->leftJoin('note_link_clicks', 'note_links.id', '=', 'note_link_clicks.link_id')
            ->select(
                'note_links.*',
                DB::raw('COALESCE(SUM(note_link_clicks.clicks), 0) AS click'),
                DB::raw('COALESCE(SUM(note_link_clicks.revenue), 0) AS income')
            )
            ->where('users.id', '=', $userId)
            ->where('note_links.status', 1)
            ->groupBy('note_links.user_id', 'note_links.id', 'note_link_clicks.clicks')
            ->groupBy('note_links.user_id', 'note_links.id', 'note_links.alias', 'note_links.title', 'note_links.content', 'note_links.password', 'note_links.level', 'note_links.created_at', 'note_links.updated_at', 'note_links.status')
            ->latest()                       
            ->paginate(10);
                
        
        $note_domain = $this->settingService->get('note_short_url');
        $protocol = $request->secure() ? 'https' : 'http';
        $note_short_url = empty($note_domain) ? $request->url().'/' : $protocol.'://'.$note_domain.'/';

        $data['title'] = 'Liên kết';
        $data['content'] = 'note-links';

        $data['user_detail'] = $request->user();
        $data['user_stu_links'] = $results;
        $data['settings'] = $this->settingService->all();
        $data['note_short_url'] = $note_short_url;

        return view('layouts.member.dashboard_layout', compact('data'));
    }

    public function apiTokens(Request $request) 
    {
        $userId = $request->user()->id;
        $user = User::find($userId);

        $results = ApiToken::where('user_id', $userId)->where('status', 1)->paginate(10);

        

        $data['title'] = 'Mã API';
        $data['content'] = 'api-tokens';

        $data['user_detail'] = $request->user();
        $data['user_api_tokens'] = $results;

        return view('layouts.member.dashboard_layout', compact('data'));
    }
    public function quickLink(Request $request)
    {
        $userId = $request->user()->id;
        $user = User::find($userId);

        $results = ApiToken::where('user_id', $userId)->where('status', 1)->get();

        

        $data['title'] = 'Liên kết nhanh';
        $data['content'] = 'quick-link';

        $data['user_detail'] = $request->user();
        $data['user_api_tokens'] = $results;

        return view('layouts.member.dashboard_layout', compact('data'));  
    }
    public function withdraw(Request $request)
    {
        $user = User::where('id', '=', $request->user()->id)->first();

        

        $data['title'] = 'Rút tiền';
        $data['content'] = 'withdraw';

        $data['__withdraw'] = $user->getWithdraw()->orderByDesc('created_at')->paginate(10);

        $data['user_detail'] = $request->user();
        $data['settings'] = $this->settingService->all();

        return view('layouts.member.dashboard_layout', compact('data'));

    }
    public function postWithdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required',
        ]);

        $amount = $request->amount;
        $type = $request->input('form-control') == 'fast' ? 1 : 0;
        $costs = $type === 1 ? 10 : 0;
        $validAmounts = array(3, 5, 10, 20, 30, 50, 80, 100, 500, 800, 1000, 2000, 5000, 8000);
        if (!in_array($request->amount, $validAmounts)) {
            return redirect()->back()->withErrors('Giá trị không hợp lệ');
        }

        $user = User::where('id', '=', $request->user()->id)->first();
        $balance = $this->total($user)['balance'];
        if ($amount > $balance) {
            return redirect()->back()->withErrors('Số dư không đủ, cày cuốc mạnh lên đi nào :3');
        }

        $user = User::where('id', '=', $request->user()->id)->firstOrFail();
        $dataPmt = $user->payment()->first();

        if ($dataPmt) {
            $data = [
                'amount' => $request->amount,
                'costs' => $costs,
                'type' => $type,
                'user_id' => $request->user()->id,
                'payment_method' => $dataPmt->payment_method,
                'payment_account_number' => $dataPmt->payment_account_number,
                'payment_account_name' => $dataPmt->payment_account_name,
                'payment_bank_name' => $dataPmt->payment_bank_name
            ];
            UserWithdraw::create($data);
            $messageTlg = 'Yêu cầu thanh toán mới!' . "\n" . 
            '- Số tiền: $' . $request->amount . "\n" . 
            '- Phí rút: $' . ($costs * $request->amount / 100) . ' (' . ($costs * $request->amount / 100) * 22000 . ' vnđ)' . "\n" .
            '- Kiểu rút: *' . ($type == 1 ? 'NHANH' : 'CHẬM') . '*';
          
            $user->notify(new TlgNotification('1715580830', $messageTlg));
            return redirect()->back()->with('success', 'Đơn rút ($'.$request->amount.') của bạn đang được xử lý.');
        }
        return redirect()->back()->withErrors('Vui lòng bổ sung thông tin thanh toán để yêu cầu rút tiền.');
    }

    public function changePassword(Request $request)
    {
        $user = User::where('id', '=', $request->user()->id)->first();
        $userPayment = $user->payment->first();

        

        $data['title'] = 'Đổi mật khẩu';
        $data['content'] = 'change-password';

        $data['user_detail'] = $request->user();
        $data['settings'] = $this->settingService->all();

        return view('layouts.member.dashboard_layout', compact('data'));
    }
    public function postChangePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required|regex:/^[a-zA-Z0-9]+$/',
            'new_password' => 'required|confirmed',
        ], [
            'old_password.regex' => 'Mật khẩu không được có dấu, khoảng trắng hoặc kí tự đặc biệt'
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->withErrors('Mật khẩu cũ không khớp!');
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Đã thay đổi mật khẩu thành công!');
    }
    public function error() {
        $data['title'] = 'Error 404: Not Found';
        return view('errors.404-dashboard');
    }
    // upload images note
    public function upload(Request $request)
    {
       if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }
}
