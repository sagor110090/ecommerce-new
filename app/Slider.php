<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{

    protected $table = 'sliders';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';


    protected $fillable = ['slider_background', 'slider_lable1', 'slider_lable2', 'slider_lable3', 'slider_lable4', 'header', 'description'];

    
}