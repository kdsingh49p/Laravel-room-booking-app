<?php

namespace App;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tbl_company extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_company';
    protected $primaryKey = 'company_id';
   
 	

}
