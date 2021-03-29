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
            'phone_country' => ['required_with:phone'],
            'phone' => ['required', 'phone'],
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
     * Create user for the settings.
     * 
     * @param \App\Models\Settings $settings
     * @param array $input
     * @return \App\Models\User $user
     */
    public function createUser(Settings $settings, $input)
    {
        $user = User::create([
            'settings_id' => $settings->id,
            'name' => $input['name'],
            'email' => $input['email'],
            'phone_country' => $input['phone_country'],
            'phone' => $input['phone'],
            'password' => Hash::make($input['password'])
        ]);

        return $user;
    }
}
