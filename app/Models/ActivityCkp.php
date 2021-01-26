<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityCkp extends Model
{
    use HasFactory;
    protected $table = 'activity_ckp';
    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo(Ckp::class, 'post_id');
    }
}
