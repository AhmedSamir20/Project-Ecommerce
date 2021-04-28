<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['imageable_id','imageable_type','photo','created_at','updated_at'];

    public function imageable()
    {
        return $this->morphTo();
    }

    //accessors
    public function  getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/products/' . $val): "";
    }
}
