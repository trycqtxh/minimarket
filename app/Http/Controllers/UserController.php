<?php

namespace App\Http\Controllers;

use App\Transformers\UserTransformer;
use App\Users;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function users(Users $users)
    {
        $users = $users->all();

        return fractal()
            ->collection($users)
            ->transformWith(function($users){
                return [
                    'id'=>$users->id,
                    'nama'=>$users->nama
                ];
            })
            ->toArray();
    }
}
