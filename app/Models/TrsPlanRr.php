<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrsPlanRr extends Model
{
   
    protected $table = 'trs_plan_rr';
    protected $primaryKey = 'id';

    public function plan()
    {
        return $this->belongsTo(TrsPlan::class, 'id');
    }
}
