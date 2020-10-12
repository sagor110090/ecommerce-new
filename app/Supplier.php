<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{

    protected $table = 'suppliers';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'address', 'phone_number', 'total_paid_amount', 'total_paid_due'];

    public function purchase()
    {
        return $this->hasMany('App\Purchase');
    }

}