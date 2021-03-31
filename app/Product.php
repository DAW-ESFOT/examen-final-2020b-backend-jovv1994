<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    protected $fillable = ['name', 'code', 'price'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->user_id = Auth::id();
        });
    }

    //RELACIONES UNO A MUCHOS INVERSA
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    //RELACIONES DE MUCHOS A MUCHOS
    public function suppliers()
    {
        return $this->belongsToMany('App\Supplier')->withTimestamps();
    }
}
