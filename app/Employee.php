<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';

    public function company()
    {
    	return $this->hasOne('App\Company','id','company_id');
    }
}
