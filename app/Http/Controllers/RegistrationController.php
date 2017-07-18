<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationForm;

class RegistrationController extends Controller
{

    public function __construct()
    {
        // IDK it doesn't redirects properly when goes /register uri when logged, its mine tune
        $this->middleware('guest');
    }

    public function create() {
        return view('registration.create');
    }

    public function store(RegistrationForm $form) {

        // Validate the form
        /* done in Requests/RegistrationForm.php      $this->validate(request(), [
            'name' => 'required|min:2',
            'email' => 'required|email',
            'password' =>'required|confirmed'
        ]);
        */

        // Create and save the user
        /*
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);
        */
        /* done in Requests/RegistrationFormp
        // from tutorial. not working logging after pushing non-encrypted password
        $user = User::create(request(['name', 'email', 'password']));

        // Sign them in
        auth()->login($user);

        // it will fetch email address out of that object
        \Mail::to($user)->send(new Welcome($user));
        */

        $form->persist();

        // creates a new session
        //session();

        // flashes something to the session, so it will be available for exactly one page load, one request
        // perfect for status messages
        session()->flash('message', 'Thanks so much for signing up!');

        // Redirect to the home page
        return redirect()->home();
    }
}
