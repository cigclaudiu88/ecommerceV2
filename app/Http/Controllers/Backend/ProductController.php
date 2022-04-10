<?php

namespace App\Http\Controllers\Backend;

// adaugat namespace pentru a putea folosi clasa (modelele) Brand,Category si Product
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
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

        // validari inserare produse in tabelul products
        $request->validate(
            [
                // numele brandului este necesar
                'brand_id' => 'required',
                // numele categoriei este necesar
                'category_id' => 'required',
                // numele subcategoriei este necesar
                'subcategory_id' => 'required',
                // numele subsubcategoriei este necesar
                'subsubcategory_id	' => 'required',
                // numele produsului este necesar, trebuie sa fie unic in tabelul products si trebuie sa fie un string de minim 6 caractere
                'product_name' => 'required|unique:products|min:6',
                // codul produsului este necesar, trebuie sa fie unic in tabelul products si trebuie sa fie un string de minim 6 caractere
                'product_code' => 'required|unique:products|min:6',
                // cantitatea produsului este necesara, trebuie sa fie un numar intreg
                'product_quantity' => 'required|numeric',
                // pretul produsului este necesar, trebuie sa fie un numar z
                'selling_price' => 'required|numeric',
                // descrierea scurta a produsului este necesara, trebuie sa fie un string de minim 10 caractere
                'short_description' => 'required|min:10',
                // specificatiile produsului sunt necesare, trebuie sa fie un string de minim 10 caractere
                'specifications' => 'required|min:10',
                // descrierea lunga a produsului este necesara, trebuie sa fie un string de minim 10 caractere
                'long_description' => 'required|min:10',
                // imaginea principala a produsului este necesara, trebuie sa fie un imagine de tip .jpg, .png sau .jpeg 
                'product_thumbnail' => 'required|image|mimes:jpeg,png,jpg',
            ],
            // mesaje speciale pentru fiecare tip de eraoare la inserare produselor in 
            [
                'brand_id.required' => 'Numele brandului de produse este necesar.',
                'category_id.required' => 'Numele categoriei de produse este necesar.',
                'subcategory_id.required' => 'Numele subcategoriei de produse este necesar.',
                'subsubcategory_id.required' => 'Numele subsubcategoriei de produse este necesar.',

                'product_name.required' => 'Numele categoriei de produse este necesar.',
                'product_name.unique' => 'Numele produsului trebuie sa fie unic.',
                'product_name.min' => 'Numele produsului trebuie sa fie de minim 6 caractere.',

                'product_code.required' => 'Codul produsului este necesar.',
                'product_code.unique' => 'Codul produsului trebuie sa fie unic.',
                'product_code.min' => 'Codul produsului trebuie sa fie de minim 6 caractere.',

                'product_quantity.required' => 'Cantiatea produsului este necesara.',
                'product_quantity.numeric' => 'Cantiatea produsului trebuie sa fie un numar intreg.',

                'selling_price.required' => 'Pretul produslui este necesar.',
                'selling_price.numeric' => 'Pretul produsului trebuie sa fie o valoare nimerica zecimala.',

                'short_description.required' => 'Descrierea scurta a produsului este necesara.',
                'short_description.min' => 'Descrierea scurta a produsului trebuie sa contina minim 10 caractere.',

                'specifications.required' => 'Specificatiile produsului sunt necesare.',
                'specifications.min' => 'Specificatiile produsului trebuie sa contina minim 10 caractere.',

                'long_description.required' => 'Descrierea lunga a produsului este necesara.',
                'long_description.min' => 'Descrierea lunga a produsului trebuie sa contina minim 10 caractere.',

                'product_thumbnail.required' => 'Imaginea principala a produsului este necesara.',
                'product_thumbnail.image' => 'Imaginea principala a produsului trebuie sa fie o imagine.',
                'product_thumbnail.mimes' => 'Imaginea principala a produsului trebuie sa fie o imagine de tip .jpg, .png sau .jpeg.',
            ]
        );


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
    // functia pentru vizualizare / managementul tuturor produselor
    public function ManageProduct()
    {
        // $products preia toate produsele din tabela products
        $products = Product::latest()->get();
        // returnam pagina de management a tuturor produselor cu datele din tabela products
        return view('backend.product.product_view', compact('products'));
    }
    // functia pentru editarea unui produs
    public function ProductEdit($id)
    {
        // $multiImgs preia toate imaginile multiple din tabela multi_img pentru id-ul produsului care va fi editat primit ca parametru
        $multiImgs = MultiImg::where('product_id', $id)->get();

        // $brands preia toate brandurile din tabela brands
        $brands = Brand::latest()->get();
        // $categories preia toate categorile din tabela categories
        $categories = Category::latest()->get();
        // $subcategories preia toate subcategorile din tabela sub_categories
        $subcategories = SubCategory::latest()->get();
        // $subsubcategories preia toate subsubcategorile din tabela sub_sub_categories
        $subsubcategories = SubSubCategory::latest()->get();
        // $product preia toata informatia a unui produs cu id-ul primit ca parametru
        $products = Product::findOrFail($id);
        // returnam pagina de editare a unui produs cu datele din tabelele products, brands, categories, sub_categories, sub_sub_categories si multi_img
        return view('backend.product.product_edit', compact('brands', 'categories', 'subcategories', 'subsubcategories', 'products', 'multiImgs'));
    }

    // functia pentru actualizarea datelor unui produs fara actualizarea imaginii
    public function ProductDataUpdate(Request $request)
    {
        // validari inserare produse in tabelul products
        $request->validate(
            [
                // numele brandului este necesar
                'brand_id' => 'required',
                // numele categoriei este necesar
                'category_id' => 'required',
                // numele subcategoriei este necesar
                'subcategory_id' => 'required',
                // numele subsubcategoriei este necesar
                'subsubcategory_id	' => 'required',
                // numele produsului este necesar, trebuie sa fie unic in tabelul products si trebuie sa fie un string de minim 6 caractere
                'product_name' => 'required|min:6',
                // codul produsului este necesar, trebuie sa fie unic in tabelul products si trebuie sa fie un string de minim 6 caractere
                'product_code' => 'required|min:6',
                // cantitatea produsului este necesara, trebuie sa fie un numar intreg
                'product_quantity' => 'required|numeric',
                // pretul produsului este necesar, trebuie sa fie un numar z
                'selling_price' => 'required|numeric',
                // descrierea scurta a produsului este necesara, trebuie sa fie un string de minim 10 caractere
                'short_description' => 'required|min:10',
                // specificatiile produsului sunt necesare, trebuie sa fie un string de minim 10 caractere
                'specifications' => 'required|min:10',
                // descrierea lunga a produsului este necesara, trebuie sa fie un string de minim 10 caractere
                'long_description' => 'required|min:10',
                // imaginea principala a produsului este necesara, trebuie sa fie un imagine de tip .jpg, .png sau .jpeg 
                'product_thumbnail' => 'required|image|mimes:jpeg,png,jpg',
            ],
            // mesaje speciale pentru fiecare tip de eraoare la inserare produselor in 
            [
                'brand_id.required' => 'Numele brandului de produse este necesar.',
                'category_id.required' => 'Numele categoriei de produse este necesar.',
                'subcategory_id.required' => 'Numele subcategoriei de produse este necesar.',
                'subsubcategory_id.required' => 'Numele subsubcategoriei de produse este necesar.',

                'product_name.required' => 'Numele categoriei de produse este necesar.',
                'product_name.min' => 'Numele produsului trebuie sa fie de minim 6 caractere.',

                'product_code.required' => 'Codul produsului este necesar.',
                'product_code.min' => 'Codul produsului trebuie sa fie de minim 6 caractere.',

                'product_quantity.required' => 'Cantiatea produsului este necesara.',
                'product_quantity.numeric' => 'Cantiatea produsului trebuie sa fie un numar intreg.',

                'selling_price.required' => 'Pretul produslui este necesar.',
                'selling_price.numeric' => 'Pretul produsului trebuie sa fie o valoare nimerica zecimala.',

                'short_description.required' => 'Descrierea scurta a produsului este necesara.',
                'short_description.min' => 'Descrierea scurta a produsului trebuie sa contina minim 10 caractere.',

                'specifications.required' => 'Specificatiile produsului sunt necesare.',
                'specifications.min' => 'Specificatiile produsului trebuie sa contina minim 10 caractere.',

                'long_description.required' => 'Descrierea lunga a produsului este necesara.',
                'long_description.min' => 'Descrierea lunga a produsului trebuie sa contina minim 10 caractere.',

                'product_thumbnail.required' => 'Imaginea principala a produsului este necesara.',
                'product_thumbnail.image' => 'Imaginea principala a produsului trebuie sa fie o imagine.',
                'product_thumbnail.mimes' => 'Imaginea principala a produsului trebuie sa fie o imagine de tip .jpg, .png sau .jpeg.',
            ]
        );
        // $product_id preia id-ul produsului care va fi editat din campul hidden din formularul de editare a unui produs
        $product_id = $request->id;

        // folosind modelul Product, actualizam datele unui produs cu id-ul primit ca parametru
        Product::findOrFail($product_id)->update([
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

            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        // adaugam un mesaj de succes la actualizarea datelor unui produs
        $notification = array(
            'message' => 'Produsul a fost actualizat cu succes!',
            'alert-type' => 'info'
        );
        // redirectionam catre pagina de management a unui produs
        return redirect()->route('manage-product')->with($notification);
    }

    // functia de actualizare poze multiple a unui produs
    public function ProductMultiImageUpdate(Request $request)
    {
        // $imgs salveaza datele multiple de tip imagine primite de la formularul de editare a unui produs
        $imgs = $request->multi_img;

        // loop though $imgs 
        // iteram prin fiecare imagine din $imgs ca id=>img
        foreach ($imgs as $id => $img) {
            // $imgDel este un array care contine id-urile imaginilor care vor fi sterse aferente unui produs
            $imgDel = MultiImg::findOrFail($id);

            // stergem imaginea veche din folderul public/product_images
            unlink($imgDel->photo_name);
            // $make_name retine numele generat unic pentru fiecare imagine
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            // salvam imaginea in folderul public/product_images
            Image::make($img)->save('upload/products/multi-image/' . $make_name);
            // actualizam imaginea in tabela multi_img
            $uploadPath = 'upload/products/multi-image/' . $make_name;

            // actualizam datele din tabela multi_img pentru imaginea cu in care id-ul primit ca parametru este egal cu id-ul din tabela multi_img
            MultiImg::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]);
        }

        // adaugam un mesaj de succes la actualizarea datelor unui produs
        $notification = array(
            'message' => 'Pozele produsului au fost actualizate cu succes!',
            'alert-type' => 'info'
        );
        // redirectionam catre pagina de management a unui produs cu notificare
        return redirect()->back()->with($notification);
    }
}