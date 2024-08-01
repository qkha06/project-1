<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function home() {
        return view('clients.landing-page');
    }
    public function viewPage(string $slug) {
        $pageData = Page::where('slug', $slug)->firstOrFail();
        if ($pageData) {
            return view('clients.view-page', compact('pageData'));
        }
    }
}
