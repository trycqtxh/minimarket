<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    public $timestamps = false;
    protected $fillable = ['id', 'status'];

    //users - status
    public function users()
    {
        return $this->hasMany(Users::class, 'id_status');
    }

    //Menu - aturan_menu - Status
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'aturan_menu', 'id_status', 'id_menu');
    }

    //Submenu - aturan_submenu - Status
    public function submenus()
    {
        return $this->belongsToMany(Menu::class, 'aturan_submenu', 'id_status', 'id_submenu');
    }

    public function hasAnyAturanMenu($aturan)
    {
        if(is_array($aturan)){
            foreach($aturan as $atur){
                if($this->hasAturanMenu($atur)){
                    return true;
                }
            }
        }else{
            if($this->hasAturanMenu($aturan)){
                return true;
            }
        }
        return false;
    }

    public function hasAturanMenu($aturan)
    {
        if($this->menus()->where('title', $aturan)->first()){
            return true;
        }
        return false;
    }

    public function hasMenu($status)
    {
        if(is_string($status))
        {
            return $this->menus->contains('title', $status);
        }

        return !! $status->intersect($this->menus)->count();
    }
}
