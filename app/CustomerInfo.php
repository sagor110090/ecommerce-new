<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{

    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
    // protected $fillable = ['name', 'subCategory_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function shippingDetail()
    {
        return $this->hasOne('App\ShippingDetail');
    }
    public function orders()
    {
        return $this->hasMany('App\Order', 'customerInfo_id');
    }
    public function compare()
    {
        return $this->hasMany('App\Compare', 'customer_id', 'id');
    }

}