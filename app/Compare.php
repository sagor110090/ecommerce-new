<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compare extends Model
{
    protected $table = 'compare';

    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
    public function customer()
    {
        return $this->belongsTo('App\CustomerInfo', 'customer_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}