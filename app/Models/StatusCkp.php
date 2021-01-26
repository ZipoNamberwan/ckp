<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusCkp extends Model
{
    use HasFactory;
    protected $table = 'statuses';
    protected $guarded = [];
    public $timestamps = false;
}
