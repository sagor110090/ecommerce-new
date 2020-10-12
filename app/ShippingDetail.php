<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingDetail extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['shipping', 'paymentmethod'];

    public function customerInfo()
    {
        return $this->belongsTo('App\CustomerInfo');
    }
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}