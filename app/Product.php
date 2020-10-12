<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'sku', 'category_id', 'subcategory_id', 'minicategory_id', 'type_id', 'brand_id', 'featured', 'color_id', 'size_id', 'quantity', 'regular_price', 'sale_price', 'thumbnail1', 'thumbnail2', 'image1', 'image2', 'image3', 'short_description', 'long_description', 'supplier_id', 'slug'];

    public function type()
    {
        return $this->belongsTo('App\Type');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function subCategory()
    {
        return $this->belongsTo('App\SubCategory', 'subcategory_id');
    }
    public function miniCategory()
    {
        return $this->belongsTo('App\MiniCategory', 'minicategory_id');
    }
    public function color()
    {
        return $this->belongsTo('App\Color');
    }
    public function size()
    {
        return $this->belongsTo('App\Size');
    }
    public function orderItem()
    {
        return $this->hasMany('App\OrderItem');
    }
    public function compare()
    {
        return $this->hasMany('App\Compare');
    }
    public function offer()
    {
        return $this->hasMany('App\Compare');
    }

}