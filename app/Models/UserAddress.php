<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function district()
    {
        // legatura intre tabela  tabela useradresses (user_id) si users (id)
        return $this->belongsTo(ShipDistrict::class, 'city', 'district_name');
    }

    // pentru afisare status utilizator
    public function UserOnline()
    {   // returnam Cache pentru userul logat
        return Cache::has('user-is-online' . $this->id);
    }
}