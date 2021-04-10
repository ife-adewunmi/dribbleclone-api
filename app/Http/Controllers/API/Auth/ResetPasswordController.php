<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    */

    use ResetsPasswords;
    
    /**
     * Method sendResetResponse
     *
     * @param Request $request [explicite description]
     * @param $response $response [explicite description]
     *
     * @return void
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json(['status' => trans($response)], 200);
    }
    
    /**
     * Method sendResetFailedResponse
     *
     * @param Request $request [explicite description]
     * @param $response $response [explicite description]
     *
     * @return void
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['email' => trans($response)], 200);
    }
}
