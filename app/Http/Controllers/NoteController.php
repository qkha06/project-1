<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\NoteAnalysis;
use App\Models\NOTELinkClick;
use App\Models\NOTELink;
use App\Models\Setting;
use Carbon\Carbon;

use Jenssegers\Agent\Agent;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    public function create(Request $request)
    {   
        try {
            $data = $request->all();

            if (empty($data['content']) || empty(($data['title']))) {
                return response()->json(['status' => 'error', 'message' => 'Missing data field']);
            }

            $userId = $request->user() ? $request->user()->id : 0;
            $alias = Str::random(config('config.alias_​length'));
            
            do {
                $alias = Str::random(config('config.alias_​length'));
                $unique = NOTELink::where('alias', $alias)->doesntExist();
            } while (!$unique);

            NOTELink::create([
                'user_id' => $userId,
                'alias' => $alias,
                'title' => ($data['title']),
                'content' => ($data['content']),
                'password' => ($data['password']),
                'status' => 1,
                'level' => 0
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

            if (empty($data['content']) || empty(($data['title']))) {
                return response()->json(['status' => 'error', 'message' => 'Missing data field']);
            }

            if ($request->user() && $request->user()->id) {
                $userId = $request->user()->id;
            } else {
                return response()->json(['status' => 'error', 'message' => 'Invalid user']);
            }
            $dataUpd = [
                'user_id' => $userId,
                'title' => ($data['title']),
                'content' => ($data['content']),
            ];

            if (!empty($data['password'])) {
                $dataUpd['password'] = $data['password'];
            } else {
                $dataUpd['password'] = null;
            }

            $affectedRows = NOTELink::where('user_id', $userId)->where('alias', $alias)->update($dataUpd);

            if ($affectedRows > 0) {
                return response()->json(['status' => 'success', 'alias' => $alias]);
            }
            
            return response()->json(['status' => 'error', 'message' => 'Update failure...']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'An error occurred while processing your request'], 500);
        }
    }
    public function delete($alias, Request $request)
    {
        $affectedRows = NOTELink::where('user_id', $request->user()->id)->where('alias', $alias)->update(['status' => 0]);
        if ($affectedRows > 0) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }
    public function show(Request $request, $alias)
    {
        {
            $this->count($request, $alias);

            $data = NOTELink::select('note_links.*', DB::raw('COALESCE(SUM(note_link_clicks.clicks), 0) AS clicks'))
            ->leftJoin('note_link_clicks', 'note_link_clicks.link_id', '=', 'note_links.id')
            ->where('note_links.alias', $alias)
            ->where('note_links.status', 1)
            ->groupBy('note_links.id', 'note_links.alias')
            ->firstOrFail();

            return view('fontend.note.show', compact('data'));
        }

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
        // $st = Setting::where('key', 'rate')->first();
        // if ($st->count() >= 1) {
        //     $rate = json_decode($st->value, true);
        // } else {
        //     $rate = [[0.00, 1], [0.00, 1], [0.00, 1]];
        // }
        $rate = [[0.00, 10], [0.00, 10], [0.00, 10]];

        $response = [];
        $referer = $request->headers->get('referer');

        if (!empty($alias)) {
            
            $ip_address = $request->ip();

            $dtLink = NOTELink::where('alias', $alias)->first();
            $user_id = $dtLink->user_id;

            $visited = NoteAnalysis::where('ip_address', $ip_address)
            ->whereDate('created_at', Carbon::today())
            ->where('user_id', $user_id)
            ->get();

            if ((0 <= $visited->count()) && ($visited->count() < $rate[$dtLink->level_id][1])) {
                //chưa truy cập
                $check = NOTELinkClick::firstOrNew([
                    'link_id' => $dtLink->id,
                    'date' => Carbon::today()->toDateString()
                ]);
                
                if (!$check->exists) {
                    $check->clicks = 1;
                    $check->revenue = $rate[$dtLink->level_id][0];
                    $check->save();
                } else {
                    $check->increment('clicks');
                    $check->increment('revenue', $rate[$dtLink->level_id][0]);
                }

                $agent = new Agent();
                $ipData = [
                    'status' => 'success',
                    'ip_address' => $request->ip(),
                    'country' => $agent->languages()[0],
                    'detection' => null,
                    'browser' => $agent->browser(),
                    'platform' => $agent->platform(),
                    'device' => $agent->isMobile() ? 'Mobile' : ($agent->isTablet() ? 'Tablet' : 'Desktop')
                ];

                $ip_address = $ipData['ip_address'];
                $country = $ipData['country'];
                $detection = $ipData['detection'];
                $browser = $ipData['browser'];
                $platform = $ipData['platform'];
                $device = $ipData['device'];

                $analysisData = [
                    'user_id' => $dtLink->user_id,
                    'parent_id' => $check->id,
                    'revenue' => $rate[$dtLink->level_id][0],
                    'created_at' => now(),
                    'ip_address' => $ip_address,
                    'referral' => empty($referer) ? 'direct' : $referer,
                    'country' => $country,
                    'browser' => $browser,
                    'platform' => $platform,
                    'device' => $device,
                ];
                
                NoteAnalysis::create($analysisData);
                
                $response = [
                    'status' => 'success',
                    'totalViewsToday' => ($visited->count())+1
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'limit views'
                ];
            }
         
        } else {
            echo 'Missing data field';
        }

        return response()->json($response);
    }
}
