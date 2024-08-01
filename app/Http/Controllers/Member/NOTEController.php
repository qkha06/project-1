<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\NOTEServiceInterface as NOTEService;

class NOTEController extends Controller
{

    protected $NOTEService;

    public function __construct(NOTEService $NOTEService)
    {
        $this->NOTEService = $NOTEService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $user_note_links = $this->NOTEService->index($request);

        return view('backend.member.note-link.index', compact('user_note_links'));
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
