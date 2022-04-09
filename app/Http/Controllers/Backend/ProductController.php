<?php

namespace App\Http\Controllers\Backend;

// adaugat namespace pentru a putea folosi clasa (modelele) Brand,Category si Product
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{

    // functia de afisare a tuturor produselor
    public function AddProduct()
    {
        // $brands preiau toate brandurile din tabela brands
        $brands = Brand::latest()->get();
        // $categories preiau toate categoriile din tabela categories
        $categories = Category::latest()->get();
        // returnam pagina de adaugare a unui produs cu datele din tabelele brands si categories
        return view('backend.product.product_add', compact('brands', 'categories'));
    }
    // functia de
    public function ProductStore(Request $request)
    {
        // $image preia imaginea principala din formularul de adaugare a unui produs
        $image = $request->file('product_thumbnail');
        // $name_gen genereaza un nume unic pentru imaginea principala din formularul de adaugare a unui produs
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        // se va salva imaginea principala din formularul de adaugare a unui produs in folderul public/images/products
        Image::make($image)->save('upload/products/thumbnail/' . $name_gen);
        // $save_url salveaza imaginea principala din formularul de adaugare a unui produs in upload/products/thumbnail cu numele unic generat anterior
        $save_url = 'upload/products/thumbnail/' . $name_gen;

        // $product_id preia id-ul produsului care va fi adaugat in tabela products cu datele din formularul de adaugare a unui produs
        // $product_id este cuprinde toata informatia produselor CU EXCEPTIA imaginilor multiple
        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name' => $request->product_name,
            'product_slug' =>  strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code' => $request->product_code,
            'product_quantity' => $request->product_quantity,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'specifications' => $request->specifications,

            'hot_deal' => $request->hot_deal,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deal' => $request->special_deal,

            'product_thumbnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);


        // inserarea in tabela multi_img a imaginilor din formularul de adaugare a unui produs
        // $images preia imaginile multiple din formularul de adaugare a unui produs
        $images = $request->file('multi_img');
        // iteram prin toate imaginile multiple din formularul de adaugare a unui produs
        foreach ($images as $img) {
            // le generam nume unice pentru fiecare imagine din formularul de adaugare a unui produs
            $multi_img_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->save('upload/products/multi-image/' . $multi_img_name);
            // le salvam in folderul public/images/products/multi_img
            $uploadPath = 'upload/products/multi-image/' . $multi_img_name;

            // inseram in tabela multi_img imaginile generate anterior
            MultiImg::insert([
                // $product_id este toata informatia CU EXCEPTIA imaginilor multiple
                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        }
        // adaugam un mesaj de succes la adaugarea unui produs
        $notification = array(
            'message' => 'Produsul a fost adaugat cu succes!',
            'alert-type' => 'success'
        );
        // redirectionam catre pagina de adaugare a unui produs
        return redirect()->route('manage-product')->with($notification);
    }
}