<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    // face toate campurile prezente sau viitoare din tabelul products accesibile
    protected $guarded = [];

    // legatura cu tabelul ship_divisions
    public function division()
    {
        return $this->belongsTo(ShipDivision::class, 'division_id', 'id');
    }
    // legatura cu tabelul ship_districts
    public function district()
    {
        return $this->belongsTo(ShipDistrict::class, 'district_id', 'id');
    }
    // legatura cu tabelul users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // legatura cu tabelul user_addresses
    public function user_address()
    {
        return $this->belongsTo(UserAddress::class, 'user_id', 'user_id');
    }
}