<?php

namespace App\Actions\Jetstream;

use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        if($user->role == 'owner') {
            $settings = $user->settings;
        
            foreach($settings->users as $user) {
                $user->deleteProfilePhoto();
                $user->tokens->each->delete();
                $user->delete();
            }

            $settings->delete();
        } else {
            abort(403);
        }
        
    }
}
