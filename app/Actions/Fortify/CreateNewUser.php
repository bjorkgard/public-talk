<?php

namespace App\Actions\Fortify;

use App\Models\Settings;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            $settings = Settings::create([
                'extra' => [],
            ]);

            $user = $this->createUser($settings, $input);

            return $user;
        });
    }

    /**
     * Create personal settings for the user.
     * 
     * @param \App\Models\Settings $settings
     * £param array $input
     */
    public function createUser(Settings $settings, $input)
    {
        $user = User::create([
            'settings_id' => $settings->id,
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'password' => Hash::make($input['password'])
        ]);

        return $user;
    }
}
