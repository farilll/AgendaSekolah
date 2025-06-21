<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaUserModel extends Model
{
    use HasFactory;

    protected $table = "agenda_user";
    protected $fillable = ['user_id', 'agenda_id', 'alasan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agenda()
    {
        // return $this->belongsTo(AgendaModel::class);
        return $this->belongsTo(AgendaModel::class, 'agenda_id');
    }

}
