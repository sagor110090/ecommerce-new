<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{

    protected $table = 'colors';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';


    protected $fillable = ['name'];

    public function purchaseItem()
    {
        return $this->hasMany('App\PurchaseItem');
    }
    
}