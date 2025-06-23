<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\Auth\MicrosoftSocialiteProvider;
use Laravel\Socialite\Facades\Socialite;

class MicrosoftController extends Controller
{
    public function redirectToMicrosoft()
    {
        return Socialite::buildProvider(MicrosoftSocialiteProvider::class, [
            'client_id' => config('services.microsoft.client_id'),
            'client_secret' => config('services.microsoft.client_secret'),
            'redirect' => config('services.microsoft.redirect'),
            'scopes' => ['openid', 'offline_access', 'User.Read', 'Files.ReadWrite'],
        ])->redirect();
    }

    public function handleMicrosoftCallback()
    {
        $user = Socialite::buildProvider(MicrosoftSocialiteProvider::class, [
            'client_id' => config('services.microsoft.client_id'),
            'client_secret' => config('services.microsoft.client_secret'),
            'redirect' => config('services.microsoft.redirect'),
        ])->stateless()->user();

        session([
            'microsoft_token' => $user->token,
            'microsoft_refresh_token' => $user->refreshToken,
        ]);

        return redirect()->route('student.subirdocumentos', ['c_numdoc' => session('c_numdoc')])
            ->with('success', '✅ Conectado a OneDrive.');
    }

}
