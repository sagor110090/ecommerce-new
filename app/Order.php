<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

    public function shippingBetails()
    {
        return $this->hasOne('App\ShippingDetail');
    }
    public function orderItem()
    {
        return $this->hasMany('App\OrderItem');
    }
    public function customer()
    {
        return $this->belongsTo('App\CustomerInfo', 'customerInfo_id');
    }
}