<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrsPlanImages extends Model
{
    
    protected $table = 'trs_plan_images';
    protected $primaryKey = 'id';

    public function plan()
    {
        return $this->belongsTo(TrsPlan::class, 'id');
    }

    protected $fillable = [
        'plan_id',
        'created_at',
        'updated_at',
        'file_name',
        'type'
    ];

}
