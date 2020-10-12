<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    protected $table = 'blogs';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'content', 'thumbnail', 'image', 'user_id', 'slug'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}