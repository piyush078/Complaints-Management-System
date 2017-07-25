<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    public function device()
    {
        return $this->belongsTo('App\Device', 'dev_id');
    }

    public function user ()
    {
    	return $this->belongsTo('App\User');
    }

    public function maintainer () 
    {
    	return $this->belongsTo('App\User', 'mai_id');
    }
}
