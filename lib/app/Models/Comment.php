<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
        protected $fillable = [
        'content', 'user_id', 'product_id'
    ];
    public $timestamps = false;
    public function user()
    {
    	return $this->belongTo('App\Models\User');
    }
       public function product()
    {
    	return $this->belongTo('App\Models\Product');
    }
}
