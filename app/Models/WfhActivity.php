<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WfhActivity extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'kegiatan';
}
