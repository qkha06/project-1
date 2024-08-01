<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Member\Interfaces\STUServiceInterface as STUService;
use App\Repositories\Interfaces\STURepositoryInterface as STURepository;

class STUController extends Controller
{
    protected $STUService;
    protected $STURepository;
    
    public function __construct(STUService $STUService, STURepository $STURepository)
    {
        $this->STUService = $STUService;
        $this->STURepository = $STURepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {  
        $links = $this->STUService->index($request);

        $user_stu_links = $links;
        
        return view('backend.member.stu-link.index', compact('user_stu_links'));
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
