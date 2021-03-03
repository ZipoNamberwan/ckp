<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubmittedCkp extends Model
{
    use HasFactory;
    protected $table = 'submitted_ckp';
    protected $guarded = [];
    use SoftDeletes;

    public function assessor()
    {
        return $this->belongsTo(User::class, 'assessor_id');
    }

    public function ckp()
    {
        return $this->belongsTo(CkpR::class, 'ckp_r_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusCkp::class, 'status_id');
    }
}
