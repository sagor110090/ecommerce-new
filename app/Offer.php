<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    protected $table = 'offers';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';


    protected $fillable = ['product_id', 'ending_date_time', 'offer_percentage'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    
}