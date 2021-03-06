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

    // functia care aduce subsubcategoria aferenta subcategoriei selectate in formularul de adaugare a produselor
    public function GetSubSubCategory($subcategory_id)
    {
        // $subcat salveaza toate datele din tabela sub_sub_categories, care au subcategory_id egal cu $subcategory_id primit ca parametru din formularul de adaugare produse
        $subsubcat = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name', 'ASC')->get();
        return json_encode($subsubcat);
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
    // functia de
    public function SubSubCategoryEdit($id)
    {
        // $categories salveaza toate datele din tabela categories si le ordoneaza crescator dupa category_name folosind functia orderBy si modelul Category
        $categories = Category::orderBy('category_name', 'ASC')->get();
        // $subsubcategories salveaza toate datele din tabela sub_subcategories si le ordoneaza crescator dupa subsubcategory_name folosind functia orderBy si modelul SubSubCategory
        $subcategories = SubCategory::orderBy('subcategory_name', 'ASC')->get();
        // $subsubcategories salveaza toate datele din tabela sub_sub_categories care au id-ul $id primit ca parametru
        $subsubcategories = SubSubCategory::findOrFail($id);
        // returneaza datele din $categories, $subcategories si $subsubcategories catre view-ul resources\views\backend\category\sub_subcategory_edit.blade.php
        return view('backend.category.sub_subcategory_edit', compact('categories', 'subcategories', 'subsubcategories'));
    }

    // functia de actualizare a subsubcategoriei
    public function SubSubCategoryUpdate(Request $request)
    {

        // $subsubcat_id primeste id-ul subsubcategoriei din formularul de editare din campul ascuns
        $subsubcat_id = $request->id;

        // validari inserare subsubcategorie in tabelul sub_subcategories
        $request->validate(
            [
                // id-ul (numele categoriei) categoriei este necesar
                'category_id' => 'required',
                // id-ul (numele subcategoriei) subcategoriei este necesar
                'subcategory_id' => 'required',
                'subsubcategory_name' => 'required|min:3',
            ],
            // mesaje speciale pentru fiecare tip de eraore la inserare categorie
            [
                'category_id.required' => 'Numele categoriei de produse este necesar.',
                'subcategory_id.required' => 'Numele subcategoriei de produse este necesar.',
                'subsubcategory_name.required' => 'Numele categoriei de produse este necesar.',
                'subsubcategory_name.min' => 'Numele subsubcategoriei de produse trebuie sa contina minim 3 caractere.',
            ]
        );
        // se actualizeaza in tabelul sub_sub_categories valorile primite din campurile nume categorie, nume subcategorie si nume subsubcategorie din formularul de actualizare
        // pentru id-ul subsubcategoriei cu id-ul salvat in $subsubcat_id
        SubSubCategory::findOrFail($subsubcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name' => $request->subsubcategory_name,
            // subsubcateory_slug este generat cu litere mici si _ intre cuvinte daca au spatiu
            'subsubcategory_slug' => strtolower(str_replace(' ', '_', $request->subsubcategory_name)),
        ]);

        // afisam mesajul de succes la actualizarea subsubcategoriei
        $notification = array(
            'message' => 'Subsubcategoria a fost actualizata cu succes!',
            'alert-type' => 'info'
        );
        // redirectionam la aceeasi pagina cu mesajul $notification
        return redirect()->route('all.subsubcategory')->with($notification);
    }

    // functia de stergere a subsubcategoriei
    public function SubSubCategoryDelete($id)
    {
        // se cauta in tabelul sub_sub_categories subsubcategoria cu id-ul $id primit ca parametru si se sterge
        SubSubCategory::findOrFail($id)->delete();

        // afisam mesajul de succes la stergerea subsubcategoriei
        $notification = array(
            'message' => 'Subsubcategoria a fost stearsa cu succes!',
            'alert-type' => 'info'
        );
        // 
        return redirect()->back()->with($notification);
    }
}