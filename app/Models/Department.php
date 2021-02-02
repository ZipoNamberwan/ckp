<?php

namespace App\Models;

use App\Traits\SelfReferenceTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, SelfReferenceTrait;
    protected $guarded = [];
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
