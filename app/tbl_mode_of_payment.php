<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tbl_mode_of_payment extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_mode_of_payment';
    protected $primaryKey = 'mode_of_payment_id';
     protected $fillable = [
              'title'
  				    ];
  
}