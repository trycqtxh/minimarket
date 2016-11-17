<?php
/**
 * Created by PhpStorm.
 * User: Faisal Abdul Hamid
 * Date: 05/10/2016
 * Time: 23:36
 */

namespace App\Transformers;


use App\Users;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(Users $user)
    {
        return [
            'id' => $user->id,
            'nama' => $user->nama,
            'username' => $user->username,
            'action' => $user->action
        ];
    }
}