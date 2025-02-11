<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Statamic\Events\UserSaved;

class UserController extends Controller
{
    public function create(CreateUserRequest $request)
    {
        $validated = $request->validated();

        if ($validated) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));

            Auth::login($user);

            return response()->json([
                'redirect' => route('profile.show')
            ]);
        }
    }

    public function authenticate(LoginUserRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->to('/profile');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
