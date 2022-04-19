<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;
    // face toate campurile prezente sau viitoare din tabelul categories accesibile
    protected $guarded = [];


    // functia de legatura cu tabelul categories
    public function category()
    {
        // legatura intre tabela subcategories (category_id) si tabela categories (id)
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subcategory()
    {
        // legatura intre tabela sub_subcategories (subcategory_id) si tabela subcategories (id)
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'subsubcategory_id', 'id');
    }
}
