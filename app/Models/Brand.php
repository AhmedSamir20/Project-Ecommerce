<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use Translatable;

    protected $with=['translations'];

    protected $fillable=['is_active','photo'];

    protected $casts=[
        'is_active'=>'boolean',
    ];

    protected $translatedAttributes = ['name'];

    protected $hidden=['translations'];
    //======Scope=======
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function getActive(){
        return  $this -> is_active  == 0 ?  __('admin/brand.not active')   : __('admin/brand.active') ;
    }

    //accessors
    public function  getPhotoAttribute($val){
        return ($val !== null) ? asset('assets/images/brands/' . $val) : "";
    }

}
