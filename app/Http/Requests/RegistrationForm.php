<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\User;
use App\Mail\Welcome;

class RegistrationForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2',
            'email' => 'required|email',
            'password' =>'required|confirmed'
        ];
    }

    // most people don't do this, even tutorial author doesn't do often.
    public function persist() {
        // from tutorial. not working logging after pushing non-encrypted password
        $user = User::create(
            $this->only(['name', 'email', 'password'])
        );

        // Sign them in
        auth()->login($user);

        // it will fetch email address out of that object
        \Mail::to($user)->send(new Welcome($user));
    }

}
