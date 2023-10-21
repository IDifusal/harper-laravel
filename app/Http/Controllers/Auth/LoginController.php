<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            if ($user->hasVerifiedEmail()) {
                // User is authenticated and email is verified
                $token = $user->createToken('auth_token')->plainTextToken;
    
                return response()->json(['access_token' => $token]);
            } else {
                // Email is not verified, set email_verification_required to true
                return response()->json([
                    'email_verification_required' => true,
                    'message' => 'Email verification required',
                ], 403);
            }
        }
    
        return response()->json(['message' => 'This user doesnt exists Please create an account'], 401);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Revoke the user's current token
        $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
