<?php

namespace App\Http\Controllers\Backend;

// adaugam modelul Brand
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// adaugam clasa de lucru cu imagini din Image Intervention Package
use Intervention\Image\ImageManagerStatic as Image;

class BrandController extends Controller
{
    // functia de vizualizare branduri din tabelul brands pe pagina resources\views\backend\brand\brand_view.blade.php
    public function BrandView()
    {
        // $brand preia ultimele date din tabelul brands folosind modelul Brand cu functia get()
        $brands = Brand::latest()->get();
        // returns this view resources\views\backend\brand\brand_view.blade.php with $brands data
        return view('backend.brand.brand_view', compact('brands'));
    }

    public function BrandStore(Request $request)
    {
        // validari pentru inserarea brandurlir
        $request->validate(
            [
                // numele brandului trebuie sa fie un string de minim 3 caractere
                'brand_name' => 'required|min:3',
                // imaginea este necesara si trebuie sa fie de tipul jpeg, png gif sau svg
                'brand_image' => 'required|image|mimes:jpeg,png,jpg,svg',
            ],
            // mesaje speciale pentru fiecare tip de eraore
            [
                'brand_name.required' => 'Numele brandului este ncesesar.',
                'brand_name.min' => 'Numele brandului trebuie sa contina minim 3 caractere.',
                'brand_image.required' => 'Imaginea brandului este necesara.',
                'brand_image.image' => 'Imaginea brandului trebuie sa fie de tipul jpeg, png, gif sau svg.',
                'brand_image.mimes' => 'Imaginea brandului trebuie sa fie de tipul jpeg, png, gif sau svg.',
            ]
        );
        // $image preia imaginea din formularul de inserare din campul brand_image
        $image = $request->file('brand_image');
        // $nume_gen genereaza un nume random pentru imaginea brandului folosind hexdec() cu uniqid()
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        // using the Image model (image intervention package) we resize the $image to width 300 height 200 and save into upload/brand/ with $name_gen
        // folosind Image model (image intervention package) redimenzionam imaginea $image la latimea 300 si inaltimea 200 si salvam imaginea in upload/brand/ cu numele $name_gen
        Image::make($image)->resize(300, 200)->save('upload/brand/' . $name_gen);
        // salvam imaginea $save_url in folderul upload/brand/ cu numele $name_gen
        $save_url = 'upload/brand/' . $name_gen;


        // inseram valorile primite din campurile brand_name,slug, imaginea din formularul de inserare in tabelul brands folosind modelul Brand si functia insert()
        Brand::insert([
            'brand_name' => $request->brand_name,
            // brand_slug este generat cu litere mici si _ intre cuvinte daca au spatiu
            'brand_slug' => strtolower(str_replace(' ', '_', $request->brand_name,)),
            'brand_image' => $save_url,
        ]);

        // Adaugat notificare Toastr
        $notification = array(
            'message' => 'Brandul a fost inserat cu succes!',
            'alert-type' => 'success'
        );

        // redirect inapoi cu notificare
        return redirect()->back()->with($notification);
    }
}
