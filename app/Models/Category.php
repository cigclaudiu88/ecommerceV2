<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // face toate campurile prezente sau viitoare din tabelul categories accesibile
    protected $guarded = [];
}