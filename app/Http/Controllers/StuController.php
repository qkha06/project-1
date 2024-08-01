<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StuLink;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Level;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Arr;
use GuzzleHttp\Client;
use App\Services\Home\Interfaces\STUServiceInterface as STUService;
use App\Repositories\Interfaces\STURepositoryInterface as STURepository;
use App\Repositories\Interfaces\STULogReferralRepositoryInterface as STULogReferralRepository;
use App\Repositories\Interfaces\STUAccessRepositoryInterface as STUAccessRepository;
use App\Repositories\Interfaces\STUStatisticRepositoryInterface as STUStatisticRepository;

class StuController extends Controller
{
    protected $STUService;
    protected $STURepository;
    protected $STULogReferralRepository;
    protected $STUAccessRepository;
    protected $STUStatisticRepository;

    public function __construct(
        STUService $STUService,
        STURepository $STURepository,
        STULogReferralRepository $STULogReferralRepository,
        STUAccessRepository $STUAccessRepository,
        STUStatisticRepository $STUStatisticRepository,
    ) {
        $this->STUService = $STUService;
        $this->STURepository = $STURepository;
        $this->STULogReferralRepository = $STULogReferralRepository;
        $this->STUAccessRepository = $STUAccessRepository;
        $this->STUStatisticRepository = $STUStatisticRepository;
    }

    public function create(Request $request)
    {   
        try {
            $data = $request->all();

            if (empty($data['lnk'])) {
                return response()->json(['status' => 'error', 'message' => 'Missing data field']);
            }

            $userId = $request->user() ? $request->user()->id : 0;
            $alias = Str::random(config('config.alias_​length'));
            
            do {
                $alias = Str::random(config('config.alias_​length'));
                $unique = StuLink::where('alias', $alias)->doesntExist();
            } while (!$unique);

            $level = isset($data['oth']) && isset($data['oth']['level']) ? base64_decode($data['oth']['level']) : 0;
        
            StuLink::create([
                'user_id' => $userId,
                'alias' => $alias,
                'data' => json_encode($data),
                'status' => 1,
                'level_id' => $level
            ]);
            
            return response()->json(['status' => 'success', 'alias' => $alias]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'An error occurred while processing your request'], 500);
        }
    }
    public function update($alias, Request $request)
    {   
        try {
            $data = $request->all();

            if (empty($data['lnk'])) {
                return response()->json(['status' => 'error', 'message' => 'Missing data field']);
            }

            if ($request->user() && $request->user()->id) {
                $userId = $request->user()->id;
            } else {
                return response()->json(['status' => 'error', 'message' => 'Invalid user']);
            }

            $level = isset($data['oth']) && isset($data['oth']['level']) ? base64_decode($data['oth']['level']) : 1;

            $roles = $request->user()->getRoleNames()->toArray();
            if (in_array("super-admin", $roles) || in_array("admin", $roles)) {

                $affectedRows = StuLink::where('alias', $alias)->update([
                    'alias' => $alias,
                    'data' => json_encode($data),
                    'status' => 1,
                    'level_id' => $level
                ]);

            } else {
                $affectedRows = StuLink::where('user_id', $userId)->where('alias', $alias)->update([
                    'alias' => $alias,
                    'data' => json_encode($data),
                    'status' => 1,
                    'level_id' => $level
                ]);
            }

            if ($affectedRows > 0) {
                return response()->json(['status' => 'success', 'alias' => $alias]);
            }
            
            return response()->json(['status' => 'error', 'message' => 'Invalid user']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'An error occurred while processing your request'], 500);
        }
    }
    public function delete($alias, Request $request)
    {
        $affectedRows = StuLink::where('user_id', $request->user()->id)->where('alias', $alias)->update(['status' => 0]);
        if ($affectedRows > 0) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }
    public function redirect(Request $request, $alias)
    {
        $referrer = $request->headers->get('referer', 'direct');

        $ip_address = generate_random_ip("1.150.113.16");
        $ip_address = $request->ip();

        $link_data = $this->STURepository->firstByCondition([[DB::raw('BINARY alias'), '=', $alias], ['status', '=', 1]], ['level']);
        if ($link_data) {
            $identifier = generateUniqueIdentifier($request);
            $data = $this->STULogReferralRepository->updateOrInsert([
                'link_id' => $link_data->id,
                'ip_address' => $ip_address,
                
            ], [
                'identifier' => $identifier,
                'referrer_url' => $referrer,
                'visited_at' => now()
            ]);

            $pages = array_filter(array_map('trim', explode(',', $link_data->level->redirect_url)), 'strlen');
            $page_decode = Arr::random($pages);

            return redirect()->away($page_decode.'?a='.$alias);
        }

        return abort(404);
    }
    private function getData(Request $request)
    {
        $clientIP = $request->ip();

        $client = new Client();

        $keys = [
            '3d844x-2044oy-i64t8z-t48l47',
            '64tr9v-532925-1f25k4-513v59',
            'b713dc-5p8391-u4a035-384c2n',
            '20222v-id69d3-k7d2c7-0z70x7',
            '04771s-43211f-q6225f-26003g',
            '7198k5-jro0v9-e1rb0r-947839',
        ];
        
        $randomKey = $keys[array_rand($keys)];

        $response = $client->request('GET', 'http://proxycheck.io/v2/'.$clientIP.'?key=', [
            'query' => [
                'key' => $randomKey,
                'vpn' => '1',
                'asn' => '1',
                'risk' => '1',
                'port' => '1',
                'seen' => '1',
                'days' => '7',
                'tag' => 'msg'
            ]
        ]);

        $statusCode = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $agent = new Agent();

        $browser = $agent->browser();
        $platform = $agent->platform();

        if ($agent->isMobile()) {
            $device = 'Mobile';
        } elseif ($agent->isTablet()) {
            $device = 'Tablet';
        } else {
            $device = 'Desktop';
        }

        if ($statusCode == 200) {
            $data = json_decode($content, true);

            if ($data['status'] == 'ok') {
                $keys = array_keys($data);
                $ipDt = $data[$keys[1]];

                $res = [
                    'status' => 'success',
                    'ip_address' => $keys[1],
                    'country' => $ipDt['country'],
                    'code' => $ipDt['isocode'],
                    'detection' => $ipDt['proxy'] == 'yes' ? $ipDt['type'] : null,
                    'browser' => $browser,
                    'platform' => $platform,
                    'device' => $device
                ];

                return $res;
            }

            return response()->json($data);
        } else {
            return response()->json(['error' => 'Unable to fetch data'], $statusCode);
        }

    }
    public function count(Request $request, $alias)
    {   
        try {
            $ip_address = $request->ip();

            $invalid_ip = ['0.0.0.0', '127.0.0.1'];

            if (in_array($ip_address, $invalid_ip)) {
                // return response()->json([
                //     'status' => 'error',
                //     'message' => 'invalid ip'
                // ]);
                // $ip_address = generate_random_ip("21.150.113.16");

            }

            $link_data = $this->STURepository->firstByCondition([[DB::raw('BINARY alias'), '=', $alias], ['status', '=', 1]], ['level']);
            if (!$link_data) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid alias'
                ]);
            }

            $loged = $this->STULogReferralRepository->firstByCondition([
                ['link_id', '=', $link_data->id],
                ['ip_address', '=', $ip_address],
                ['visited_at', '>=', Carbon::now()->subMinutes(60)]
            ]);
            if (!$loged) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid authentication'
                ]);
            }

            if ($link_data->user_id == 0) {
                $accessed = $this->STUAccessRepository->getAccessedByCondition([['ip_address', '=', $ip_address], ['link_id', '=', $link_data->id]], Carbon::today());
            } else {
                $accessed = $this->STUAccessRepository->getAccessedByCondition([['ip_address', '=', $ip_address], ['user_id', '=', $link_data->user_id]], Carbon::today());
            }

            if (count($accessed) >= $link_data->level->click_limit) {
                return response()->json([
                    'status' => 'error',
                    'message'=> 'limited click, '.'clicked today '.count($accessed)
                ]);
            }

            //update stats
            $this->STUStatisticRepository->updateOrInsertStatsByAttr([
                'link_id' => $link_data->id,
                'date' => Carbon::today()->toDateString()
            ], $link_data->level->click_value);

            $create_data = [
                'user_id' => $link_data->user_id,
                'parent_id' => $link_data->id, //static_id
                'link_id' => $link_data->id, //link_id
                'revenue' => $link_data->level->click_value,
                'created_at' => now(),
                'ip_address' => $loged->ip_address,
                'identifier' => $loged->identifier,
                'referral' => $loged->referrer_url,
                'country' => null,
                'browser' => null,
                'platform' => null,
                'device' => null,
                'detection' => null,
            ];
            $this->STUAccessRepository->create(
                $create_data
            );

            return response()->json([
                'status' => 'success',
                'message'=> 'visits +1, '.'clicked today '.(count($accessed)+1)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message'=> '505'
            ]);
        }  
    }
    public function fetch($alias)
    {
        function encodeURIComponent($str) {
            $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
            return strtr(rawurlencode($str), $revert);
        }
        function decodeURIComponent($str) {
            return rawurldecode($str);
        }
        function ecSTU($text) {
            $utf8Text = encodeURIComponent($text);
            $encodedText = base64_encode($utf8Text);
            return $encodedText;
        }
        
        function dcSTU($encodedText) {
            $decodedText = base64_decode($encodedText);
            $originalText = decodeURIComponent($decodedText);
            return $originalText;
        }
        $nameButton = [
            'yt' => ecSTU('Subscribe on YouTube'),
            'ytl' => ecSTU('Like on YouTube'),
            'ytc' => ecSTU('Comment on YouTube'),
            'ytlc' => ecSTU('Like & Comment on YouTube'),
            'tg' => ecSTU('Join Group on Telegram'),
            'tk' => ecSTU('Follow on TikTok'),
            'tkl' => ecSTU('Like on TikTok'),
            'ig' => ecSTU('Follow on Instagram'),
            'igl' => ecSTU('Like on Instagram'),
            'fb' => ecSTU('Follow on Facebook'),
            'fbl' => ecSTU('Like on Facebook'),
            'dc' => ecSTU('Join Group on Discord'),
            'lnk' => ecSTU('Continue')
        ];

        $iconButon = [
            'yt' => ecSTU('yt'),
            'ytl' => ecSTU('ytl'),
            'ytc' => ecSTU('ytc'),
            'ytlc' => ecSTU('ytlc'),
            'tg' => ecSTU('tg'),
            'tk' => ecSTU('tk'),
            'tkl' => ecSTU('tkl'),
            'ig' => ecSTU('ig'),
            'igl' => ecSTU('igl'),
            'fb' => ecSTU('fb'),
            'fbl' => ecSTU('fbl'),
            'ct' => ecSTU('ct'),
            'dc' => ecSTU('dc'),
            'lnk' => ecSTU('lnk')
        ];

        $res = ['config' => [], 'data' => []];

        $result = DB::select("SELECT user_id, data, status, level_id FROM `stu_links` WHERE BINARY alias = ? AND status = ?", [$alias, 1]);

        if (!empty($result)) {
            $row = $result[0];
            $user_id = $row->user_id;
            $dtSTU = $row->data;
            $level = $row->level_id;
            $dataConfig = Level::find($level);
            if (empty($dataConfig)){
                return response()->json(['message' => 'Error config']);
            }
            $config = json_decode(json_decode($dataConfig->config), true);

            $res['data']['btn'] = [];
            $res['config'] = $config;
            $res['data']['lnk'] = [];
            $res['data']['oth'] = [];

            $dtSTU = json_decode($dtSTU, true);

            $steps = isset($dtSTU['btn']) ? $dtSTU['btn'] : [];
            $destinations = isset($dtSTU['lnk']) ? $dtSTU['lnk'] : [];
            $other = isset($dtSTU['oth']) ? $dtSTU['oth'] : [];

            $text_BTN = [];
            $url_BTN = [];
            $pattern = '/\d{1}[a-zA-Z]$/';


            foreach (['btn' => $steps, 'lnk' => $destinations] as $type => $jsonArray) {
                if ($type == 'lnk') {
                    if ($jsonArray !== null && is_array($jsonArray)) {
                        foreach ($jsonArray as $key => $value) {
                            $key_ = preg_replace('/\d+/', '', $key);

                            if (preg_match($pattern, $key)) {
                                $text_BTN[$key] = $value;
                                continue;
                            }

                            $jsonAct = [
                                'url' => $value,
                                'ic' => $iconButon['lnk'],
                                'name' => isset($text_BTN[$key.'t']) ? $text_BTN[$key.'t'] : $nameButton[$key_],
                            ];
                            $res['data'][$type][$key] = $jsonAct;
                        }
                    }
                } else {
                    if ($jsonArray !== null && is_array($jsonArray)) {
                        foreach ($jsonArray as $key => $value) {
                            $key_ = preg_replace('/\d+/', '', $key);

                            if (preg_match($pattern, $key)) {
                                $text_BTN[$key] = $value;
                                continue;
                            }

                            $jsonAct = [
                                'url' => $value,
                                'ic' => isset($iconButon[$key_]) ? ecSTU($key_) : ecSTU('yt'),
                                'name' => isset($nameButton[$key_]) ? $nameButton[$key_] : $text_BTN[$key.'t'],
                            ];
                            $res['data'][$type][$key] = $jsonAct;
                        }
                    }
                }
            }

            if ($other !== null) {
                $res['data']['oth']['ttl'] = $other['ttl'] ?? ecSTU('Unlock Link');
                $res['data']['oth']['sttl'] = $other['sttl'] ?? ecSTU('Hoàn thành các bước để mở khóa link, bạn chỉ mất 30 giây.');
                $res['data']['oth']['note'] = $other['note'] ?? ecSTU('Tham gia kiếm tiền cùng Link4Sub, có ngay 500k/ngày. <a href="https://link4sub.com/" target="__blank">(Tham gia)</a>');
                $res['data']['oth']['lv'] = ecSTU($level);
                $res['data']['oth']['pwd'] = $other['pwd'] ?? false;
                $res['data']['oth']['thmb'] = $other['thmb'] ?? false;
                $res['data']['oth']['exp'] = $other['exp'] ?? false;
            }

            $res['data']['info']['alias'] = $alias;
            $res['data']['info']['userId'] = $user_id;
            $res['data']['info']['url_count'] = route('stu.count', $alias);

            return response()->json($res);
        } else {
            return response()->json(['message' => 'No records found.']);
        }

    }
    public function loadd()
    {
        return view('load');
    }
    public function decode()
    {
        return view('decode');
    }
}