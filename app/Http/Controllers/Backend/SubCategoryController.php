<?php

namespace App\Http\Controllers\Backend;

// adaugat namespace pentru a putea folosi clasa CategoryController si SubCategoryController
use App\Models\Category;
use App\Models\SubCategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    // functia de vizualizare a subcategorii
    public function SubCategoryView()
    {
        // $categories preia datele din tabelul categories folosind modelul Category si functia get() si le ordoneaza ascendent dupa nume categorie
        $categories = Category::orderBy('category_name', 'ASC')->get();
        // $subcategories preia ultimele date din tabelul subcategories folosind modelul SubCategory si functia get() 
        $subcategories = SubCategory::latest()->get();
        // returnam pagina subcategory_view cu datele din $categories si $subcategories 
        return view('backend.category.subcategory_view', compact('subcategories', 'categories'));
    }

    // functia de adaugare a subcategorii in tabelul subcategories
    public function SubCategoryStore(Request $request)
    {
        // validari inserare subcategorie in tabelul categories
        $request->validate(
            [
                // id-ul (numele categoriei) categoriei este necesar
                'category_id' => 'required',
                // numele subcategoriei trebuie sa fie un string de minim 6 caractere si unic in tabelul sub_categories
                'subcategory_name' => 'required|unique:sub_categories|min:6',
            ],
            // mesaje speciale pentru fiecare tip de eraore la inserare categorie
            [
                'category_id.required' => 'Numele categoriei de produse este necesar.',
                'subcategory_name.required' => 'Numele subcategoriei de produse este necesar.',
                'subcategory_name.min' => 'Numele subcategoriei de produse trebuie sa contina minim 6 caractere.',
                'subcategory_name.unique' => 'Numele subcategoriei de produse trebuie sa fie unic.',
            ]
        );

        // se insereaza in tabelul subcategories valorile primite din campurile category_id, subcategory_name din formularul de adaugare subcategorie
        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            // subcateory_slug este generat cu litere mici si _ intre cuvinte daca au spatiu
            'subcategory_slug' => strtolower(str_replace(' ', '_', $request->subcategory_name)),
        ]);

        // adaugam notificare de succes la inserarea subcategoriei de produse
        $notification = array(
            'message' => 'SubCategory adaugata cu succes!',
            'alert-type' => 'success'
        );
        // redirectionam la aceeasi pagina cu mesajul $notification
        return redirect()->back()->with($notification);
    }

    // functia de editare a subcategorii in tabelul subcategories
    public function SubCategoryEdit($id)
    {
        // $categories preia datele din tabelul categories folosind modelul Category si functia get() si le ordoneaza ascendent dupa id
        $categories = Category::orderBy('id', 'ASC')->get();
        // $subcategories salveaza datele din tabelul subcategories pentru id-ul primit ca parametru folosind modelul SubCategory si functia findORFail()
        $subcategories = SubCategory::findOrFail($id);
        // returnam pagina subcategory_edit cu datele din $categories si $subcategories 
        return view('backend.category.subcategory_edit', compact('subcategories', 'categories'));
    }

    // functia de 
    public function SubCategoryUpdate(Request $request)
    {
        // $subcat_id preia din campul ascuns din formularul de editare subcategorie id-ul subcategoriei de produse
        $subcat_id = $request->id;

        // validari inserare subcategorie in tabelul categories
        $request->validate(
            [
                // id-ul (numele categoriei) categoriei este necesar
                'category_id' => 'required',
                // numele subcategoriei trebuie sa fie un string de minim 6 caractere si unic in tabelul sub_categories
                'subcategory_name' => 'required|unique:sub_categories|min:6',
            ],
            // mesaje speciale pentru fiecare tip de eraore la inserare categorie
            [
                'category_id.required' => 'Numele categoriei de produse este necesar.',
                'subcategory_name.required' => 'Numele subcategoriei de produse este necesar.',
                'subcategory_name.min' => 'Numele subcategoriei de produse trebuie sa contina minim 6 caractere.',
                'subcategory_name.unique' => 'Numele subcategoriei de produse trebuie sa fie unic.',
            ]
        );

        // folosind modelul SubCategory si functia findOrFail() actualizam valorile din tabelul subcategories cu datele din formularul de editare subcategorie
        SubCategory::findOrFail($subcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            // subcateory_slug este generat cu litere mici si _ intre cuvinte daca au spatiu
            'subcategory_slug' => strtolower(str_replace(' ', '_', $request->subcategory_name)),
        ]);

        // adaugam notificare de succes la inserarea subcategoriei de produse
        $notification = array(
            'message' => 'Subcategorie actualizata cu success!',
            'alert-type' => 'info'
        );
        // redirectionam spre pagina de vizualizare subcategorii de produse cu mesajul $notification
        return redirect()->route('all.subcategory')->with($notification);
    }

    // functia de stergere a subcategorii din tabelul sub_categories
    public function SubCategoryDelete($id)
    {
        // folosind modelul SubCategory si functia findOrFail() stergem subcategoria de produse cu id-ul primit ca parametru
        SubCategory::findOrFail($id)->delete();

        // adaugam notificare de succes la inserarea subcategoriei de produse
        $notification = array(
            'message' => 'Subcategorie stearsa cu success!',
            'alert-type' => 'info'
        );
        // redirectionam spre pagina de vizualizare subcategorii de produse cu mesajul $notification
        return redirect()->back()->with($notification);
    }
}