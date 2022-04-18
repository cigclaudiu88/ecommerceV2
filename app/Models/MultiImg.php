<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiImg extends Model
{
    use HasFactory;
    // face toate campurile prezente sau viitoare din tabelul multimgs accesibile
    protected $guarded = [];
    // functia de legatura intre tabelul multimgs si tabelul products
    public function product()
    {
        // leaga tabelul multimgs (category_id) cu tabelul products (id)
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}