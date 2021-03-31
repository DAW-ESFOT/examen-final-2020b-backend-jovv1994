<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Customer extends Model
{
    protected $fillable = ['name', 'lastname', 'document'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($customer) {
            $customer->user_id = Auth::id();
        });
    }

    //RELACIONES UNO A MUCHOS
    public function products()
    {
        return $this->hasMany('App\Product');
    }

    //RELACIONES UNO A MUCHOS INVERSA
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
