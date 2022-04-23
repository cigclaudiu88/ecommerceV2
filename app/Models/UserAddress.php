<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    // face toate campurile prezente sau viitoare din tabelul categories accesibile
    protected $guarded = [];

    public function user()
    {
        // legatura intre tabela  tabela useradresses (user_id) si users (id)
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}