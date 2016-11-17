<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    protected $table = 'submenu';
    public $timestamps = false;
    protected $fillable = ['title', 'icon', 'url'];

    //Status - aturan_submenu - Submenu
    public function status()
    {
        return $this->belongsToMany(Status::class, 'aturan_submenu', 'id_submenu', 'id_status');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}
