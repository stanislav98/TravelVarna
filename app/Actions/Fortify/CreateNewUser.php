<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'phone' => ['required', 'numeric','digits:10', 'unique:users'],
            'type_id' => ['required', 'int'],
            'egn' => ['required', 'numeric','digits:10', 'unique:users'],
            'g-recaptcha-response' => 'required|captcha',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'phone' => $input['phone'],
            'type_id' => $input['type_id'],
            'egn' => $input['egn'],
            'qrcode_path' => "no",
            'qr_active' => 0,
            'active_profile' => 1,
            'notify_change_subscription' => 1,
            'notify_tickets' => 0,
            'employee_type' => 0,
        ]);
    }
}