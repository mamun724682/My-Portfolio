<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function __construct(public UserService $userService)
    {
    }

    public function show()
    {
        setPageMeta('Profile');

        $user = auth()->user();
        return view('auth.profile', compact('user'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $this->userService->updateOrCreate($request->all(), auth()->id());
//        dd($request->all());
        if ($request->password) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->back()->with('success', 'Profile updated.');
    }
}
