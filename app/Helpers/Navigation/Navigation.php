<?php
/**
 * Created by PhpStorm.
 * User: Faisal Abdul Hamid
 * Date: 30/09/2016
 * Time: 15:17
 */

namespace App\Helpers\Navigation;


use App\Helpers\Navigation\Contract\NavigationContract;
use App\Menu;
use Illuminate\Support\Facades\Auth;
use App\Users;
class Navigation implements NavigationContract
{

    public static function getMenu()
    {
        $id_user = Auth::user()->id;
        $status = Users::find($id_user)->status;
        $id_status = $status->id;
        return 	Menu::with(['submenus'=>function($q) use($id_status){
            $q->whereHas('status', function($q) use($id_status){
                $q->where('id', '=', $id_status);
            });
        }])
            ->whereHas('status', function($q) use($id_status){
                $q->where('id', '=', $id_status);
            })
            ->get()
            ->toArray();
    }
}