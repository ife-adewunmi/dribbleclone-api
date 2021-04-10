<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    */

    use AuthenticatesUsers;
    
    /**
     * Method attemptLogin
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function attemptLogin(Request $request)
    {
        // attempt to issue a token to the user based on the login credentials
        $token = $this->guard()->attempt($this->credentials($request));

        if( ! $token){
            return false;
        }

        // Get the authenticated user
        $user = $this->guard()->user();

        if($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()){
            return false;
        }

        // set the user's token
        $this->guard()->setToken($token);

        return true;
    }
        
    /**
     * Method sendLoginResponse
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        // get the tokem from the authentication guard (JWT)
        $token = (string)$this->guard()->getToken();

        // extract the expiry date of the token
        $tokenExpiryDate = $this->guard()->getPayload()->get('exp');

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $tokenExpiryDate
        ]);
    }
        
    /**
     * Method sendFailedLoginResponse
     *
     * @return void
     */
    protected function sendFailedLoginResponse()
    {
        $user = $this->guard()->user();

        if($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()){
            return response()->json(["errors" => [
                "message" => "You need to verify your email account"
            ]], 422);
        }

        throw ValidationException::withMessages([
            $this->username() => "Invalid credentials"
        ]);
    }
    
    /**
     * Method logout
     *
     * @return void
     */
    public function logout()
    {
        $this->guard()->logout();
        return response()->json(['message' => 'Logged out successfully!']);
    }
}
