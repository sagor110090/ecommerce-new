<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MiniCategory extends Model
{

    protected $table = 'mini_categories';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'subCategory_id', 'slug'];

    public function subCategory()
    {
        return $this->belongsTo('App\SubCategory', 'subCategory_id');
    }
    public function product()
    {
        return $this->hasMany('App\Product', 'minicategory_id');
    }

}