<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Store\Plan;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index() {
        return view('landing.main.index', [
            'pricing' => Plan::query()
                ->orderBy('price')
                ->get(),
        ]);
    }

    public function prizesPage() {
        return view('landing.prizes.index');
    }
}
