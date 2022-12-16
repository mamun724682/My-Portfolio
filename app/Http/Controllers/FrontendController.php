<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function __invoke()
    {
        $user = User::first();
        $experiences = Experience::active()->latest()->get();
        return view('frontend.index', compact('user', 'experiences'));
    }
}
