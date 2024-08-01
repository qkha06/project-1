<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\NOTEServiceInterface as NOTEService;

class NOTEController extends Controller
{
    protected $NOTEService;

    public function __construct(NOTEService $NOTEService) {
        $this->NOTEService = $NOTEService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $links = $this->NOTEService->index($request);

        $results = $links;

        $protocol = $request->secure() ? 'https' : 'http';
        $stu_short_url = $protocol.'://';
        $stu_short_url .= empty($stu_domain) ? $request->getHost().'/' : $stu_domain.'/';

        $data['title'] = 'Liên kết';
        $data['content'] = 'note.index';

        $data['user_stu_links'] = $results;

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
}
