<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrsPlan extends Model
{

    use SoftDeletes;
    protected $table = 'trs_plans';
    protected $primaryKey = 'id';

    public function images()
    {
        return $this->hasMany(TrsPlanImages::class,'plan_id');
    }

    public function riskRiward(){
        return $this->hasMany(TrsPlanRr::class,'plan_id');
    }

    public function pair(){
        return $this->belongsTo(MstPair::class, 'id');
    }
}
