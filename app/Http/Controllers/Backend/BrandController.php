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
        // validari pentru inserarea brandurilor
        $request->validate(
            [
                // numele brandului trebuie sa fie un string de minim 2 caractere
                'brand_name' => 'required|min:2',
                // imaginea este necesara si trebuie sa fie de tipul jpeg, png gif sau svg
                'brand_image' => 'required|image|mimes:jpeg,png,jpg,svg',
            ],
            // mesaje speciale pentru fiecare tip de eraore
            [
                'brand_name.required' => 'Numele brandului este ncesesar.',
                'brand_name.min' => 'Numele brandului trebuie sa contina minim 2 caractere.',
                'brand_image.required' => 'Imaginea brandului este necesara.',
                'brand_image.image' => 'Imaginea brandului trebuie sa fie de tipul jpeg, png, gif sau svg.',
                'brand_image.mimes' => 'Imaginea brandului trebuie sa fie de tipul jpeg, png, gif sau svg.',
            ]
        );
        // $image preia imaginea din formularul de inserare din campul brand_image
        $image = $request->file('brand_image');
        // $nume_gen genereaza un nume random pentru imaginea brandului folosind hexdec() cu uniqid()
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        // folosind Image model (image intervention package) redimenzionam imaginea $image la latimea 300 si inaltimea 200 si salvam imaginea in upload/brand/ cu numele $name_gen
        Image::make($image)->resize(185, 60)->save('upload/brand/' . $name_gen);
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
            'message' => 'Brandul a fost actualizat cu succes!',
            'alert-type' => 'success'
        );

        // redirect inapoi cu notificare
        return redirect()->back()->with($notification);
    }

    // functia de editare branduri din tabelul brands pe pagina resources\views\backend\brand\brand_edit.blade.php
    public function BrandEdit($id)
    {
        // $brands primeste $id-ul brandului care trebuie editat
        $brand = Brand::findOrfail($id);
        // returnam view-ul resources\views\backend\brand\brand_edit.blade.php cu $brand data
        return view('backend.brand.brand_edit', compact('brand'));
    }
    // functia de actualizare branduri din tabelul brands pe pagina resources\views\backend\brand\brand_edit.blade.php
    public function BrandUpdate(Request $request)
    {

        // validari pentru actualizarea brandurilor
        $request->validate(
            [
                // numele brandului trebuie sa fie un string de minim 2 caractere
                'brand_name' => 'required|min:2',
                // imaginea este necesara si trebuie sa fie de tipul jpeg, png gif sau svg
                'brand_image' => 'required|image|mimes:jpeg,png,jpg,svg',
            ],
            // mesaje speciale pentru fiecare tip de eraore
            [
                'brand_name.required' => 'Numele brandului este ncesesar.',
                'brand_name.min' => 'Numele brandului trebuie sa contina minim 2 caractere.',
                'brand_image.required' => 'Imaginea brandului este necesara.',
                'brand_image.image' => 'Imaginea brandului trebuie sa fie de tipul jpeg, png, gif sau svg.',
                'brand_image.mimes' => 'Imaginea brandului trebuie sa fie de tipul jpeg, png, gif sau svg.',
            ]
        );
        // $brand_id preia id-ul brandului care trebuie actualizat din campul cu nume id ascuns din formularul de editare
        $brand_id = $request->id;
        // $old_image preia imaginea veche a brandului care trebuie actualizata din campul ascuns cu nume old_image din formularul de editare
        $old_image = $request->old_image;

        // daca s-a selectat o imagine in formularul de editare o actualizam numele si
        if ($request->file('brand_image')) {

            // stergem imaginea veche din folderul upload/brand/ cu salvata in variabila $old_image
            unlink($old_image);
            // $image preia imaginea din formularul de inserare din campul brand_image
            $image = $request->file('brand_image');
            // $nume_gen genereaza un nume random pentru imaginea brandului folosind hexdec() cu uniqid() + $image extension type ( jpg, png etc)
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            // folosind Image model (image intervention package) redimenzionam imaginea $image la latimea 300 si inaltimea 200 si salvam imaginea in upload/brand/ cu numele $name_gen
            Image::make($image)->resize(185, 60)->save('upload/brand/' . $name_gen);
            // salvam imaginea $save_url in folderul upload/brand/ cu numele $name_gen
            $save_url = 'upload/brand/' . $name_gen;

            // update brand_name,slug, image from form into the Brand model using insert into DB
            // actualizam campurile brand_name, brand_slug, brand_image din tabelul brands cu valorile din formularul de editare pentru id-ul brandului care trebuie actualizat
            Brand::findOrfail($brand_id)->update([
                'brand_name' => $request->brand_name,
                // brand_slug este generat cu litere mici si _ intre cuvinte daca au spatiu
                'brand_slug' => strtolower(str_replace(' ', '_', $request->brand_name,)),
                'brand_image' => $save_url,
            ]);

            // Adaugat notificare Toastr
            $notification = array(
                'message' => 'Brandul a fost actualizat cu succes.',
                'alert-type' => 'info'
            );
            // redirect spre ruta all.branduri (vizualizare branduri) cu mesajul de succes
            return redirect()->route('all.brand')->with($notification);
        }
        // daca nici o imagine nu este selectata in formularul de editare doar numele brandului este actualizat
        else {
            // actualizam campurile brand_name, brand_slug, din tabelul brands cu valorile din formularul de editare pentru id-ul brandului care trebuie actualizat
            Brand::findOrfail($brand_id)->update([
                'brand_name' => $request->brand_name,
                // brand_slug este generat cu litere mici si _ intre cuvinte daca au spatiu
                'brand_slug' => strtolower(str_replace(' ', '_', $request->brand_name,)),
            ]);

            // Adaugat notificare Toastr
            $notification = array(
                'message' => 'Brand Updated Succesfully',
                'alert-type' => 'info'
            );
            // redirect spre ruta all.branduri (vizualizare branduri) cu mesajul de succes
            return redirect()->route('all.brand')->with($notification);
        }
    }
    // functia de stergere branduri din tabelul brands pe pagina resources\views\backend\brand\brand_view.blade.php
    public function BrandDelete($id)
    {
        // $brand cauta id-ul brandului care trebuie sters din tabelul brands folosind modelul Brand
        $brand = Brand::findOrFail($id);
        // $img preia imaginea brandului care trebuie stearsa din folderul upload/brand/ salvat in variabila $brand
        $img = $brand->brand_image;
        // stergem imaginea din folderul upload/brand/ salvata in variabila $img
        unlink($img);

        // stergem brandul din tabelul brands cu id-ul brandului care trebuie sters gasit prin modelul Brand
        Brand::findorFail($id)->delete();

        // Adaugat notificare Toastr
        $notification = array(
            'message' => 'Brandul a fost sters!',
            'alert-type' => 'warning'
        );

        // redirect spre ruta all.branduri (vizualizare branduri) cu mesajul de succes
        return redirect()->route('all.brand')->with($notification);
    }
}