<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    // face toate campurile prezente sau viitoare din tabelul brands accesibile
    protected $guarded = [];

    // functia care leaga tabelul tabelul reviews (product_id) cu products (id)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    // functia care leaga tabelul reviews (user_id) cu tabelul users (id)  
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}