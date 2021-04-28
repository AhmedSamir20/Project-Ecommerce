<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Translatable,
        SoftDeletes;

    /**
     * The relations to eager load on every query.
     */
    protected $with = ['translations'];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'brand_id',
        'slug',
        'sku',
        'price',
        'special_price',
        'special_price_type',
        'special_price_start',
        'special_price_end',
        'selling_price',
        'manage_stock',
        'qty',
        'in_stock',
        'is_active'
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'manage_stock' => 'boolean',
        'in_stock' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     */
    protected $dates = [
        'special_price_start',
        'special_price_end',
        'start_date',
        'end_date',
        'deleted_at',
    ];

    /**
     * The accessors to append to the model's array form.
     */


    /**
     * The attributes that are translatable.
     */

    protected $translatedAttributes = ['name', 'description', 'short_description'];


    public function scopeActive($query)
    {
        return $query->where('is_active',1);
    }
    public function getActive(){
        return  $this -> is_active  == 0 ?  __('admin/product.disactive')   : __('admin/product.active') ;
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class)->withDefault();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function option(){
        return$this->hasMany(Option::class ,'product_id' );
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function hasStock($quantity)
    {
        return $this->qty >= $quantity;
    }

    public function outOfStock()
    {
        return $this->qty === 0;
    }

    public function inStock()
    {
        return $this->qty >= 1;
    }


    public function getTotal($converted = true)
    {
        return $total =  $this->special_price ?? $this -> price;

    }

}
