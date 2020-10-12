<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{

    protected $table = 'sub_categories';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'image', 'category_id', 'slug'];

    public function miniCategory()
    {
        return $this->hasMany('App\MiniCategory', 'subCategory_id');
    }
    public function product()
    {
        return $this->hasMany('App\Product', 'subCategory_id');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

}