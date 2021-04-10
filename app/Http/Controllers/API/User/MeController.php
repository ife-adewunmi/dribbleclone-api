<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class MeController extends Controller
{    
    /**
     * Method getMe
     *
     * @return void
     */
    public function getMe()
    {
        if(auth()->check()){
            $user = auth()->user();
            return new UserResource($user);
        }
        return response()->json(null, 401);
    }
}
