<?php

namespace App\Http\Controllers;

use App\Services\CaptchaService;

class SessionsController extends Controller
{
    public function __construct() {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    public function create() {
        return view('sessions.create');
    }

    public function store(CaptchaService $captchaService) {
        //if ($captchaService->captcha() === true) {
            return $this->authenticateUser();
        //}
    }

    private function authenticateUser() {
        // Attempt to authenticate the user
        // If not, redirect back
        if (! auth()->attempt(request(['email', 'password']))) {
            return back()->withErrors([
                'message' => 'Please check your credentials and try again.'
            ]);
        };
        return redirect()->home();
    }

    public function destroy() {
        auth()->logout();

        return redirect()->home();
    }
}
