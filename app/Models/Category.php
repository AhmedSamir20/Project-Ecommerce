<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use Translatable;
    protected $with=['translations'];

    protected $translatedAttributes = ['name'];
    protected $fillable=['parent_id','slug','is_active'];
    protected $hidden=['translations'];
    protected $casts=['is_active'=>'boolean'];

    public function scopeParent($query){
        return $query -> whereNull('parent_id');
    }
    public function scopeChild($query){
        return $query -> whereNOTNull('parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function getActive(){
        return  $this -> is_active  == 0 ?  __('admin/category.not active')   : __('admin/category.active') ;
    }

      //relation between parent and children one to many "parent"=>one=>belongTo
    //"children" => many => hasMany

    public  function _parent(){
        return $this->belongsTo(self::class ,'parent_id');
    }



 //================= use in blade edit =============
    public function categories()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(self::class, 'parent_id')->with('categories');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }
//================= use in general =============
    public function _childs()
    {
        return $this->hasMany(self::class, 'parent_id');
    }





}
