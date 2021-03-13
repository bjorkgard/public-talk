<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Mail\UserInvite;
use App\Models\User;
use App\Repositories\CountryRepository;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(CountryRepository $repo) {
        $users = User::where('settings_id', Auth::user()->settings->id)->get();
        $countryCodes = $repo->getAllCountryCodes();
        
        return Inertia::render('User/Index', ['users' => $users, 'countries' => $countryCodes]);
    }

    public function store(UserStoreRequest $request) {
        $user = User::create($request->validated());

        $request->session()->flash('success', $user->name . ' är tillagd');

        return Redirect::route('users.index');
    }

    public function update(UserUpdateRequest $request, User $user) {
        $user->update($request->validated());

        $request->session()->flash('success', $user->name . ' är uppdaterad');

        return Redirect::route('users.index');
    }

    public function destroy(Request $request, User $user) {
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();

        $request->session()->flash('success', 'Användaren är raderad');

        return redirect()->route('users.index');
    }

    public function invite(Request $request, User $user) {
        if ($user) {
            $password_broker = app(PasswordBroker::class);
            $token = $password_broker->createToken($user);

            Mail::to($user)->send(new UserInvite(Auth::user(), url('/') . '/reset-password?token=' . $token . '&email=' . $user->email));

            $request->session()->flash('success', 'Användaren har fått en inbjudan via e-post');
        }

        return redirect()->route('users.index');
    }
}
