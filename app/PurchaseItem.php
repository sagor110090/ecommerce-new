<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{

    protected $table = 'purchase_items';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = ['product_id', 'color_id', 'size_id', 'quantity', 'regular_price', 'sale_price', 'thumbnail1', 'thumbnail2', 'image1', 'image2', 'image3', 'short_description', 'long_description', 'supplier_id'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function color()
    {
        return $this->belongsTo('App\Color');
    }
    public function size()
    {
        return $this->belongsTo('App\Size');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

}