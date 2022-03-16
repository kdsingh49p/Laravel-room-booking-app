<?php

namespace App;
 use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class tbl_patient extends Authenticatable
{
	use SoftDeletes;


    protected $table = 'tbl_patient';
    protected $primaryKey = 'patient_id';
 


}
