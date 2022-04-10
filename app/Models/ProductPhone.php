<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhone extends Model
{
    use HasFactory;
    // face toate campurile prezente sau viitoare din tabelul products accesibile
    protected $guarded = [];
}