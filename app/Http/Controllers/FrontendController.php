<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function __invoke()
    {
        $user = User::first();
        return view('frontend.index', compact('user'));
    }
}
