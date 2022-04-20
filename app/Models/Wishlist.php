<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    // face toate campurile prezente sau viitoare din tabelul sliders accesibile
    protected $guarded = [];
}
