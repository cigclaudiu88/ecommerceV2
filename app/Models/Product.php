<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // face toate campurile prezente sau viitoare din tabelul products accesibile
    protected $guarded = [];

    // functia de legatura cu tabelul categories
    public function productlaptop()
    {
        // legatura intre tabela productlaptops (product_id) si tabela products (id)
        return $this->belongsTo(ProductLaptop::class);
    }

    public function producttablet()
    {
        // legatura intre tabela producttablets (product_id) si tabela products (id)
        return $this->belongsTo(ProductTablet::class);
    }

    public function productphone()
    {
        // legatura intre tabela productphones (product_id) si tabela products (id)
        return $this->belongsTo(ProductPhone::class);
    }
}