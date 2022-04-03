<?php

namespace App\Http\Controllers\Backend;

// adaugat namespace pentru a putea folosi clasa CategoryController
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // functia de vizualizate categorii de produse 
    public function CategoryView()
    {
        // $categories preia ultimele datele din tabelul categories folosind modelul Category si functia get()
        $categories = Category::latest()->get();
        // returnam pagina category_view cu datele din $categories
        return view('backend.category.category_view', compact('categories'));
    }

    // functia de adaugare categorie de produse in tabelul categories
    public function CategoryStore(Request $request)
    {
        // validari inserare categorie in tabelul categories
        $request->validate(
            [
                // numele brandului trebuie sa fie un string de minim 3 caractere
                'category_name' => 'required|min:6',
                // imaginea este necesara si trebuie sa fie de tipul jpeg, png gif sau svg
                'category_icon' => 'required|min:6',
            ],
            // mesaje speciale pentru fiecare tip de eraore la inserare categorie
            [
                'category_name.required' => 'Numele categoriei de produse este necesara.',
                'category_name.min' => 'Numele categoriei de produse trebuie sa contina minim 6 caractere.',
                'category_icon.required' => 'Icoana categoriei de produse este necesara.',
                'category_icon.min' => 'Icoana categoriei de produse trebuie sa contina minim 6 caractere.',
            ]
        );

        // insert category_name,slug, icon from form into the Category model using insert into DB
        // se insereaza in tabelul categories valorile primite din campurile category_name, category_slug, category_icon
        Category::insert([
            'category_name' => $request->category_name,
            // brand_slug este generat cu litere mici si _ intre cuvinte daca au spatiu
            'category_slug' => strtolower(str_replace(' ', '_', $request->category_name)),
            'category_icon' => $request->category_icon,
        ]);

        // adaugam notificare de succes la inserarea categoriei de produse
        $notification = array(
            'message' => 'Categoria a fost adaugata cu succes!',
            'alert-type' => 'success'
        );
        // redirectionam la aceeasi pagina cu mesajul $notification
        return redirect()->back()->with($notification);
    }
}