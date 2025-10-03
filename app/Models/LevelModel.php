<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level';       // nama tabel
    protected $primaryKey = 'level_id'; // primary key
    public $timestamps = false;         // kalau tabel ga ada created_at & updated_at
}
