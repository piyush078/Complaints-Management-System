<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public function complaint () {
    	return $this->hasOne('App\Complaint', 'dev_id')->latest();
    }
}
