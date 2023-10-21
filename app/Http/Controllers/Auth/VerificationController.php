<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller
{
    /**
     * Display the email verification notice.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        return view('auth.verify-email');
    }

    /**
     * Handle the email verification.
     *
     * @param  EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify($id, $hash)
    {
        $user = User::find($id);
    
        if (!$user) {
            abort(404); // Handle this case as needed
        }
    
        if ($user->hasVerifiedEmail()) {
            $status = 'already_verified';
        } elseif (hash_equals($hash, sha1($user->getEmailForVerification()))) {
            $user->markEmailAsVerified();
            event(new Verified($user));
            $status = 'verified';
        } else {
            $status = 'invalid_link';
        }
    
        $appUrl = config('app.url'); // Retrieve the APP_URL from the config
    
        return view('auth.email-verification', compact('status', 'appUrl'));
    }
    
}
