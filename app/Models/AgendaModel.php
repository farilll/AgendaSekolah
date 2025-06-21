<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgendaModel extends Model
{
    protected $table = "agendas";
    protected $fillable = ["user_id", "judul", "deskripsi", "tanggal", "kuota"];

    public function pendaftarans()
    {
        // return $this->hasMany(AgendaUserModel::class);
        return $this->hasMany(AgendaUserModel::class, 'agenda_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
