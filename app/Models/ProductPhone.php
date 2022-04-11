<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhone extends Model
{
    use HasFactory;
    // face toate campurile prezente sau viitoare din tabelul products accesibile
    protected $guarded = [];


    // functia de legatura cu tabelul products
    public function product()
    {
        // legatura intre tabela productlaptops (product_id) si tabela products (id)
        return $this->belongsTo(Product::class);
    }
}