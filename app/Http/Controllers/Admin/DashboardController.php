<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\Interfaces\DashboardServiceInterface as DashboardService;
use App\Repositories\Interfaces\STUStatisticRepositoryInterface as STUStatisticRepository;
use App\Repositories\Interfaces\NOTEStatisticRepositoryInterface as NOTEStatisticRepository;

use Carbon\Carbon;

class DashboardController extends Controller
{
    protected $dashboardService;
    protected $STUStatisticRepository;
    protected $NOTEStatisticRepository;

    public function __construct(DashboardService $dashboardService, STUStatisticRepository $STUStatisticRepository, NOTEStatisticRepository $NOTEStatisticRepository)
    {
        $this->dashboardService = $dashboardService;
        $this->STUStatisticRepository = $STUStatisticRepository;
        $this->NOTEStatisticRepository = $NOTEStatisticRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        
        $data['title'] = 'Admin: Dashboard';
        $data['rbc'] = '<div class="input-icon">
            <span class="input-icon-addon">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
            </span>
            <input class="form-control" placeholder="" id="datepicker-icon-prepend"/>
            </div>';
        $data['content'] = 'dashboard.index';

        $stats = $this->dashboardService->index($request);


        $data['data'] = $stats;

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
