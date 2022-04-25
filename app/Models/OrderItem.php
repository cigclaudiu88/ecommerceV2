<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    // face toate campurile prezente sau viitoare din tabelul products accesibile
    protected $guarded = [];
    public function order()
    {
        // leaga tabelul multimgs (category_id) cu tabelul products (id)
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    // legatura intre tabelul order_items si tabelul products
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}