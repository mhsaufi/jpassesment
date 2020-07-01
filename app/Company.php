<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';

    public function employee()
    {
    	return $this->belongsTo('App\Employee','id','company_id');
    }
}
