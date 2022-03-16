<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    //
        protected $table = 'slider';
 		protected $fillable = [
        'title1',
        'title2',
        'image',
        'url',
        'status',
    ];
}
