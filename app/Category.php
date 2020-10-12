<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'image', 'slug'];

    public function subCategory()
    {
        return $this->hasMany('App\SubCategory', 'category_id');
    }
}