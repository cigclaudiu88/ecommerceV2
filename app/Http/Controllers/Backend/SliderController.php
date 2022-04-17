<?php

namespace App\Http\Controllers\Backend;

// includem modelul pentru tabelul sliders
use App\Models\Slider;
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
}