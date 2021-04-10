<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    */

    use SendsPasswordResetEmails;
    
    /**
     * Method sendResetLinkResponse
     *
     * @param Request $request [explicite description]
     * @param $response $response [explicite description]
     *
     * @return void
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json(['status' => trans($response)], 200);
    }
    
    /**
     * Method sendResetlinkFailedResponse
     *
     * @param Request $request [explicite description]
     * @param $response $response [explicite description]
     *
     * @return void
     */
    protected function sendResetlinkFailedResponse(Request $request, $response)
    {
        return response()->json(['email' => trans($response)], 422);
    }
}
