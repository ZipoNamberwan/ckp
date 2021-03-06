<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ckp extends Model
{
    use HasFactory;
    protected $table = 'ckp';
    protected $guarded = [];

    public function month()
    {
        return $this->belongsTo(Month::class, 'month_id');
    }

    public function year()
    {
        return $this->belongsTo(Year::class, 'year_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusCkp::class, 'status_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function activities()
    {
        return $this->hasMany(ActivityCkp::class, 'ckp_id');
    }
}
