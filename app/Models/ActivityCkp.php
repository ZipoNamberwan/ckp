<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityCkp extends Model
{
    use HasFactory;
    protected $table = 'activity_ckp';
    protected $guarded = [];
    use SoftDeletes;

    public function ckp()
    {
        return $this->belongsTo(Ckp::class, 'ckp_id');
    }
}
