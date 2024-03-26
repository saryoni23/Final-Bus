<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'no_hp'     => ['string' ],
            'tgllahir'  => ['required', 'date'],
            'password'  => $this->passwordRules(),
            'terms'     => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ],[
            'name.required'     =>  'Full Name Wajib Diisi',
            'name.min'          =>  'Full Name Minimal 5 Karakter',
            'tgllahir.required'     =>  'Tanggal Lahir Wajib Diisi',
            'email.required'        =>  'Email Wajib Diisi',
            'email.unique:users'    =>  'Email Sudah Terdaftar',
            'email.unique'    =>  'Email Sudah Terdaftar',
            'password.required'     =>  'Password Wajib Diisi',
            'password.min'          =>  'Password Minimal 6 Karakter',
            ])->validate();

        return User::create([
            'name'      => $input['name'],
            'email'     => $input['email'],
            'no_hp'     => $input['no_hp'],
            'tgllahir'  => $input['tgllahir'],
            'password'  => Hash::make($input['password']),
        ]);
    }
}
