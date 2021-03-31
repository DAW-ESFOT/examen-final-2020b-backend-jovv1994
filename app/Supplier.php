<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Supplier extends Model
{
    protected $fillable = ['name'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($supplier) {
            $supplier->registered_by = Auth::id();
        });
    }

    //RELACIONES UNO A MUCHOS INVERSA
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //RELACIONES DE MUCHOS A MUCHOS INVERSA
    public function products()
    {
        return $this->belongsToMany('App\Product')->withTimestamps();
    }
}
