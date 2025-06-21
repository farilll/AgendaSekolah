<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfileModel extends Model
{
    protected $table = 'profile'; // karena default Laravel pakai 'profiles'

    protected $fillable = [
        'user_id',
        'nis',
        'alamat',
        'no_hp',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
