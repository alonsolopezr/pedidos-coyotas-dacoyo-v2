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
            'lastname' => ['required', 'string', 'max:255'],
            'celular' => ['required', 'digits:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'street' => ['string', 'max:255'],
            'number' => ['string', 'max:255'],
            'residential' => ['string', 'max:255'],
            'postal_code' => ['string', 'max:255'],
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'lastname' => $input['lastname'],
            'celular' => $input['celular'],
            'email' => $input['email'],
            'street' => $input['street'],
            'number' => $input['number'],
            'residential' => $input['residential'],
            'postal_code' => $input['postal_code'],
            'password' => Hash::make($input['password']),
        ]);

        //$user->notify()

        return $user;
    }
}