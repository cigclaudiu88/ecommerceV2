<?php

namespace App\Http\Controllers\Backend;


use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;

class SubSubCategoryController extends Controller
{
    // functia de vizualizare a subsubcategoriilor
    public function SubSubCategoryView()
    {
        // $categories salveaza toate datele din tabela categories si le ordoneaza crescator dupa category_name folosind functia orderBy si modelul Category
        $categories = Category::orderBy('id', 'ASC')->get();
        // $subsubcategories gets all latest data from SubSubCategory Model
        // $subsubcategories salveaza toate datele din tabela sub_subcategories folosind functia get() si modelul SubSubCategory
        $subsubcategories = SubSubCategory::latest()->get();
        // returnam datele din $categories si $subsubcategories catre view-ul resources\views\backend\category\sub_subcategory_view.blade.php
        return view('backend.category.sub_subcategory_view', compact('subsubcategories', 'categories'));
    }

    // functia care aduce subcategoria aferenta categoriei selectate in formularul de adaugare a subsubcategoriei
    public function GetSubCategory($category_id)
    {
        // $subcat uses SubCategory model and matches the $category_id from category form input with a category_id from DB
        // $subcat salveaza toate datele din tabela sub_categories, care au category_id egal cu $category_id primit ca parametru din formularul de adaugare subsubcategoriei
        //  si le ordoneaza crescator dupa subcategory_name folosind functia orderBy si modelul SubCategory
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
        // returnam datele din $subcat catre view-ul resources\views\backend\category\sub_subcategory_view.blade.php encodate in json
        return json_encode($subcat);
    }

    // functia de adaugare a subsubcategoriei in tabelul sub_subcategories
    public function SubSubCategoryStore(Request $request)
    {
        // validari inserare subsubcategorie in tabelul sub_subcategories
        $request->validate(
            [
                // id-ul (numele categoriei) categoriei este necesar
                'category_id' => 'required',
                // id-ul (numele subcategoriei) subcategoriei este necesar
                'subcategory_id' => 'required',
                'subsubcategory_name' => 'required|unique:sub_sub_categories|min:3',
            ],
            // mesaje speciale pentru fiecare tip de eraore la inserare categorie
            [
                'category_id.required' => 'Numele categoriei de produse este necesar.',
                'subcategory_id.required' => 'Numele subcategoriei de produse este necesar.',
                'subsubcategory_name.required' => 'Numele categoriei de produse este necesar.',
                'subsubcategory_name.min' => 'Numele subsubcategoriei de produse trebuie sa contina minim 3 caractere.',
                'subsubcategory_name.unique' => 'Numele subsubcategoriei de produse trebuie sa fie unic.',
            ]
        );

        // se insereaza in tabelul sub_subcategories valorile primite din campurile nume categorie, nume subcategorie si nume subsubcategorie din formularul de adaugare
        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name' => $request->subsubcategory_name,
            // subsubcateory_slug este generat cu litere mici si _ intre cuvinte daca au spatiu
            'subsubcategory_slug' => strtolower(str_replace(' ', '_', $request->subsubcategory_name)),
        ]);

        // afisam mesajul de succes la inserarea subsubcategoriei
        $notification = array(
            'message' => 'Subsubcategoria a fost adaugata cu succes!',
            'alert-type' => 'success'
        );
        // redirectionam la aceeasi pagina cu mesajul $notification
        return redirect()->back()->with($notification);
    }
}