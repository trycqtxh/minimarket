<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    public $timestamps = false;
    protected $fillable = ['id', 'title', 'icon', 'url'];

    //Status - aturan_menu - submenu
    public function status()
    {
        return $this->belongsToMany(Status::class, 'aturan_menu', 'id_menu', 'id_status');
    }

    public function submenus()
    {
        return $this->hasMany(Submenu::class, 'id_menu');
    }

}
