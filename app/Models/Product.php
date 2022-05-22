<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // face toate campurile prezente sau viitoare din tabelul products accesibile
    protected $guarded = [];

    // functia de legatura cu tabela product_laptops
    public function product_laptop()
    {
        return $this->hasOne(ProductLaptop::class);
    }
    // functia de legatura cu tabela product_tablets
    public function product_tablet()
    {
        return $this->hasOne(ProductTablet::class);
    }
    //
    public function product_phone()
    {
        return $this->hasOne(ProductPhone::class);
    }


    // pentru a asigura legaturile intre tabele pentru modal afisare nume brand, nume categorie, nume subsubcategorie
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function subsubcategory()
    {
        return $this->belongsTo(SubSubCategory::class, 'subsubcategory_id', 'id');
    }
}