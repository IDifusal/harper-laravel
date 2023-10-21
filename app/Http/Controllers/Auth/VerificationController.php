<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{

        public function verify(EmailVerificationRequest $request)
        {
            dd($request->headers->all());
            // dd($request->user());
        }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }

    /**
     * Get the post-verification redirect path.
     *
     * @return string
     */
    protected function redirectPath()
    {
        return route('home'); // You can customize this to redirect to a specific page after verification
    }
}
