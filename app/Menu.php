<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
        protected $table = 'menu';
        protected $fillable = [
            'title',
            'slug',
             'parent_id',
            'page_title',
            'page_description',
            'keywords',
        	'description',
            'image',
        	'page_type',

        ];
}
