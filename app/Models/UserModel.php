<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authentictable;

class UserModel extends Authentictable
{
    use HasFactory;

    protected $table = 'm_user';      
    protected $primaryKey = 'user_id'; 
    protected $fillable = [
        'username',
        'nama',
        'password',
        'level_id',
        'created_at',
        'update_at'
    ];
    protected $hidden = ['password'];
    protected $casts = ['Password' => 'hashed'];
   public function level(): BelongsTo
{
    return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
}
}
