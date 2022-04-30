<?php

namespace App\Http\Controllers\Backend;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\BlogPostCategory;
use App\Http\Controllers\Controller;
// adaugam clasa de lucru cu imagini din Image Intervention Package
use Intervention\Image\ImageManagerStatic as Image;

class BlogController extends Controller
{
    // functia pentru afisare pagina de categorii blog
    public function BlogCategory()
    {
        // $blogcategory pretine toate categoriile din tabelul blog_post_categories
        $blogcategory = BlogPostCategory::latest()->get();
        // returnam view-ul blogcategory.blade.php si trimitem ca parametru $blogcategory
        return view('backend.blog.category.category_view', compact('blogcategory'));
    }
    // functia de adaugare categorie postare blog
    public function BlogCategoryStore(Request $request)
    {
        // validare categorii postari blog
        $request->validate([
            'blog_category_name' => 'required|min:5',
        ], [
            'blog_category_name.required' => 'Categorie postare blog este obligatorie',
            'blog_category_name.min' => 'Categorie postare blog trebuie sa contina minim 5 caractere',
        ]);
        // inseram in tabelul blog_post_categories categoria postarii blog
        BlogPostCategory::insert([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-', $request->blog_category_name)),
            'created_at' => Carbon::now(),
        ]);
        // notificare pentru inserare cu succes 
        $notification = array(
            'message' => 'Categorie postare blog adaugata cu succes!',
            'alert-type' => 'success'
        );
        // returnam view-ul blogcategory.blade.php cu notificare
        return redirect()->back()->with($notification);
    }
    // functie pentru editare categorie postare blog
    public function BlogCategoryEdit($id)
    {
        // $blogcategory preia categoria postarii blog cu id-ul $id primit ca parametru
        $blogcategory = BlogPostCategory::findOrFail($id);
        // returnam pagina blogcategory_edit.blade.php si trimitem ca parametru $blogcategory
        return view('backend.blog.category.category_edit', compact('blogcategory'));
    }
    // functie pentru actualizarea categoriei punei postari  blog
    public function BlogCategoryUpdate(Request $request, $id)
    {
        // validare categorii postari blog
        $request->validate([
            'blog_category_name' => 'required|min:5',
        ], [
            'blog_category_name.required' => 'Categorie postare blog este obligatorie',
            'blog_category_name.min' => 'Categorie postare blog trebuie sa contina minim 5 caractere',
        ]);

        // cautam in tabelul blog_post_categories categoria postarii blog cu id-ul $blogcat_id si actualizam cu datele din formular
        BlogPostCategory::findOrFail($id)->update([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-', $request->blog_category_name)),
            'created_at' => Carbon::now(),
        ]);
        // notificare pentru actualizare cu succes
        $notification = array(
            'message' => 'Categorie postare blog actualizata cu succes!',
            'alert-type' => 'info'
        );
        // returnam view-ul blogcategory.blade.php cu notificare
        return redirect()->route('blog.category')->with($notification);
    }
    // functie pentru stergere categorie postare blog
    public function BlogCategoryDelete($id)
    {
        // cautam in tabelul blog_post_categories categoria postarii blog cu id-ul = $id si stergem
        BlogPostCategory::findorFail($id)->delete();

        // Adaugat notificare Toastr
        $notification = array(
            'message' => 'Categorie postare blog stearsa cu succes!',
            'alert-type' => 'info'
        );
        // redirect spre ruta all.branduri (vizualizare branduri) cu mesajul de succes
        return redirect()->route('blog.category')->with($notification);
    }
    // functia de afisare pagina de adaugare postare blog
    public function AddBlogPost()
    {
        // $blogpost preia toate categoriile de postari din tabelul blog_post_categories
        $blogcategory = BlogPostCategory::latest()->get();
        // $blogpost preia toate postarile din tabelul blog_post
        $blogpost = BlogPost::latest()->get();
        // returnam pagina resources\views\backend\blog\post\add_post.blade.php si trimitem ca parametrii $blogpost si $blogcategory
        return view('backend.blog.post.add_post', compact('blogpost', 'blogcategory'));
    }
    // functia de viaualizare lista postari
    public function ListBlogPost()
    {   // $blogpost preia toate postarile din tabelul blog_post
        $blogpost = BlogPost::latest()->get();
        // returnam pagina blogpost.blade.php si trimitem ca parametru $blogpost
        return view('backend.blog.post.post_list', compact('blogpost'));
    }
    // functia de adaugare postare blog
    public function BlogPostStore(Request $request)
    {
        // validare postare blog
        $request->validate([
            'post_title' => 'required',
            'post_image' => 'required',
            'post_details' => 'required',
        ], [
            'post_title.required' => 'Titlul postarii blog este obligatoriu',
            'post_image.required' => 'Imaginea postarii blog este obligatorie',
            'post_details.required' => 'Continutul postarii blog este obligatorie',
        ]);
        // $image preia imaginea postarii blog din formular
        $image = $request->file('post_image');
        // $name_gen genereaza un nume random pentru imaginea postarii blog
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        // folosind image intervention setam rezolutia imaginii postarii blog la 1170x728 si o salvam in folderul public/images/blog/post
        Image::make($image)->resize(1170, 728)->save('upload/post/' . $name_gen);
        // $save_url preia url-ul imaginii postarii blog
        $save_url = 'upload/post/' . $name_gen;
        // inseram in tabelul blog_posts datele din formular
        BlogPost::insert([
            'category_id' => $request->category_id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'post_image' => $save_url,
            'post_details' => $request->post_details,
            'created_at' => Carbon::now(),
        ]);
        // notificare pentru inserare cu succes
        $notification = array(
            'message' => 'Postare blog adaugata cu succes!',
            'alert-type' => 'success'
        );
        // returnam spre pagina cu lista postarilor cu notificare
        return redirect()->route('list.post')->with($notification);
    }

    // functia de editare postare blog
    public function BlogPostEdit($id)
    {
        // $blogpost preia toate categoriile de postari din tabelul blog_post_categories
        $blogcategory = BlogPostCategory::latest()->get();
        // $blogpost preia postarea din tabelul blog_posts care are id-ul = $id primit ca parametru
        $blogpost = BlogPost::with('category')->findOrFail($id);
        // returnam pagina blogcategory_edit.blade.php si trimitem ca parametru $blogcategory
        return view('backend.blog.post.edit_post', compact('blogpost', 'blogcategory'));
    }

    public function BlogPostUpdate(Request $request)
    {
        // validare postare blog
        $request->validate([
            'post_title' => 'required',
            'post_details' => 'required',
        ], [
            'post_title.required' => 'Titlul postarii blog este obligatoriu',
            'post_details.required' => 'Continutul postarii blog este obligatorie',
        ]);
        // $post_id preia id-ul postari care trebuie actualizat din campul cu nume id ascuns din formularul de editare
        $post_id = $request->id;
        // $old_image preia imaginea veche a postarii care trebuie actualizata din campul ascuns cu nume old_image din formularul de editare
        $old_image = $request->old_image;

        // daca s-a selectat o imagine in formularul de editare o actualizam restul datelor fara imagine
        if ($request->file('post_image')) {

            // stergem imaginea veche din folderul upload/posts/  salvata in variabila $old_image
            unlink($old_image);

            // $image preia imaginea postarii blog din formular
            $image = $request->file('post_image');
            // $name_gen genereaza un nume random pentru imaginea postarii blog
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            // folosind image intervention setam rezolutia imaginii postarii blog la 1170x728 si o salvam in folderul public/images/blog/post
            Image::make($image)->resize(1170, 728)->save('upload/post/' . $name_gen);
            // $save_url preia url-ul imaginii postarii blog
            $save_url = 'upload/post/' . $name_gen;

            // update brand_name,slug, image from form into the Brand model using insert into DB
            // actualizam campurile brand_name, brand_slug, brand_image din tabelul brands cu valorile din formularul de editare pentru id-ul brandului care trebuie actualizat
            BlogPost::findOrfail($post_id)->update([
                'category_id' => $request->category_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'post_image' => $save_url,
                'post_details' => $request->post_details,
                'updated_at' => Carbon::now(),
            ]);

            // Adaugat notificare Toastr
            $notification = array(
                'message' => 'Postare de blog a fost actualizata cu succes!',
                'alert-type' => 'info'
            );
            // returnam spre pagina cu lista postarilor cu notificare
            return redirect()->route('list.post')->with($notification);
        }
        // daca nici o imagine nu este selectata in formularul de editare doar numele brandului este actualizat
        else {
            // actualizam campurile brand_name, brand_slug, din tabelul brands cu valorile din formularul de editare pentru id-ul brandului care trebuie actualizat
            BlogPost::findOrfail($post_id)->update([
                'category_id' => $request->category_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'post_details' => $request->post_details,
                'updated_at' => Carbon::now(),
            ]);

            // Adaugat notificare Toastr
            $notification = array(
                'message' => 'Postare de blog a fost actualizata cu succes!',
                'alert-type' => 'info'
            );
            // returnam spre pagina cu lista postarilor cu notificare
            return redirect()->route('list.post')->with($notification);
        }
    }

    // functia de stergere postare blog
    public function BlogPostDelete($id)
    {
        // $brand cauta id-ul postarii care trebuie sters din tabelul blog_posts folosind modelul BlogPost
        $post = BlogPost::findOrFail($id);
        // $img preia imaginea postarii care trebuie stearsa din folderul upload/posts/ salvat in variabila $post
        $img = $post->post_image;
        // stergem imaginea din folderul upload/brand/ salvata in variabila $img
        unlink($img);

        // stergem brandul din tabelul brands cu id-ul brandului care trebuie sters gasit prin modelul Brand
        BlogPost::findorFail($id)->delete();

        // Adaugat notificare Toastr
        $notification = array(
            'message' => 'Postare de blog a fost stearsa cu succes!',
            'alert-type' => 'info'
        );

        // returnam spre pagina cu lista postarilor cu notificare
        return redirect()->route('list.post')->with($notification);
    }
}