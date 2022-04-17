<?php

namespace App\Http\Controllers\Backend;

// includem modelul pentru tabelul sliders
use App\Models\Slider;
// adaugam clasa de lucru cu imagini din Image Intervention Package
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    // functia de afisare a tuturor slider-urilor
    public function SliderView()
    {
        // $sliders primeste toate slider-urile din tabela sliders folosind modelul Slider si functia get()
        $sliders = Slider::latest()->get();
        // returnam view-ul slider_view.blade.php si trimitem ca parametru $sliders
        return view('backend.slider.slider_view', compact('sliders'));
    }

    // functia de adaugare a unui slider
    public function SliderStore(Request $request)
    {
        // validarea datelor trimise prin formularul de adaugare a unui slider
        $request->validate(
            [
                'slider_title' => 'required|unique:sliders|min:6',
                'slider_description' => 'required|min:6',
                'slider_image' => 'required|image|mimes:jpeg,png,jpg',
            ],
            // mesaje erori validare campuri
            [
                'slider_title.required' => 'Campul titlu este necesar',
                'slider_title.unique' => 'Titlul slider-ului trebuie sa fie unic',
                'slider_title.min' => 'Titlul slider-ului trebuie sa contina minim 6 caractere',
                'slider_description.required' => 'Campul descriere este necesar',
                'slider_description.min' => 'Descrierea slider-ului trebuie sa contina minim 6 caractere',
                'slider_image.required' => 'Campul imagine este necesar',
                'slider_image.image' => 'Campul imagine trebuie sa fie o imagine',
                'slider_image.mimes' => 'Campul imagine trebuie sa fie o imagine de tip JPEG, PNG sau JPG',
            ]
        );
        // $image preia imaginea din formularul de inserare din campul slider_image
        $image = $request->file('slider_image');
        // $nume_gen genereaza un nume random pentru imaginea brandului folosind hexdec() cu uniqid()
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        // folosind Image model (image intervention package) redimenzionam imaginea $image la latimea 870 si inaltimea 370 si salvam imaginea in upload/brand/ cu numele $name_gen
        Image::make($image)->resize(870, 370)->save('upload/slider/' . $name_gen);
        // salvam imaginea $save_url in folderul upload/brand/ cu numele $name_gen
        $save_url = 'upload/slider/' . $name_gen;

        // inseram in tabela sliders un nou slider cu datele din formularul de inserare
        Slider::insert([
            'slider_title' => $request->slider_title,
            'slider_description' => $request->slider_description,
            'slider_image' => $save_url,
        ]);

        // afisam mesaj de notificare
        $notification = array(
            'message' => 'Slider adaugat cu succes!',
            'alert-type' => 'success'
        );
        // redirectionam catre pagina de afisare a tuturor slider-urilor cu notificare
        return redirect()->back()->with($notification);
    }
}