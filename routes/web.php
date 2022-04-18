<?php
//8. Laravel 8 Multi Auth Part 1
use App\Models\User;
//8. Laravel 8 Multi Auth Part 1

// 6. Admin Profile & Image Update Part 1
use Illuminate\Support\Facades\Route;
// 6. Admin Profile & Image Update Part 1
// 1. Frontend Template Setup Part 2
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\AdminProfileController;
// 1. Frontend Template Setup Part 2
// 3. User Profile Design Part 3
use Illuminate\Support\Facades\Auth;
// 3. User Profile Design Part 3
// 1. Brand Page Design Part 1
use App\Http\Controllers\Backend\BrandController;
// 1. Brand Page Design Part 1
// 1. Category Crud Part 1
use App\Http\Controllers\Backend\CategoryController;
// 1. Category Crud Part 1
// 5. Subcategory Crud Part 1
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
// 5. Subcategory Crud Part 1
// 1. Add Product Database and Page Design Part 1
use App\Http\Controllers\Backend\ProductController;
// 1. Add Product Database and Page Design Part 1
// 1. Upload Slider and Show All Slider List Part 1
use App\Http\Controllers\Backend\SliderController;
// 1. Upload Slider and Show All Slider List Part 1
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//8. Laravel 8 Multi Auth Part 1
Route::group(
    ['prefix' => 'admin', 'middleware' => ['admin:admin']],
    function () {
        Route::get('/login', [AdminController::class, 'loginForm']);
        Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
    }
);

// 6. Fix Error for Protect Admin Dashboard
Route::middleware(['auth:admin'])->group(function () {

    // Laravel Jetstream Default Admin Authentification route
    // 1. Admin Template Setup
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
        // checks if the authenticated user is admin to redirect to backend preventing a logged in normal user from accessing the admin dashboard
    })->name('dashboard')->middleware('auth:admin');
    // 1. Admin Template Setup
    //8. Laravel 8 Multi Auth Part 1

    // 6. Fix Error for Protect Admin Dashboard
    // Admin All Routes
    // 3. Admin Logout Option 
    // Admin Log Out
    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    // 3. Admin Logout Option
    // 6. Admin Profile & Image Update Part 1
    // adaugat ruta pentru a afisa paginii profilului admin
    Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
    // 6. Admin Profile & Image Update Part 1
    // 7. Admin Profile & Image Update Part 2
    // ruta de editare a profilului admin
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
    // 7. Admin Profile & Image Update Part 2
    // 7. Admin Profile & Image Update Part 4
    // ruta de actualizare date admin
    Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');
    // 7. Admin Profile & Image Update Part 4
    // 11. Admin Profile Change Password Part 1
    // ruta de modificare parola admin
    Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');
    // ruta de actualizare parola admin
    Route::post('/admin/update/password', [AdminProfileController::class, 'AdminUpdatePassword'])->name('admin.update.password');
    // 11. Admin Profile Change Password Part 1
}); // end Middleware Admin

// User All Routes
// Laravel Jetstream Default User Authentification route
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    // $id preia valoarea id din baza de date pentru utilizatorul autentificat
    $id = Auth::user()->id;
    // $user cauta in tabela users in baza de date utilizatorul cu id-ul $id
    $user = User::find($id);
    // returnam view-ul dashboard pentru utilizatori autentificati
    return view('dashboard', compact('user'));
})->name('dashboard');
// Home Page route
// frontpage home route
Route::get('/', [IndexController::class, 'index'])->name('welcome');
// ruta de logout utlizator
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
// ruta de date profil
Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
// ruta de actualizare date utilizator
Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
// ruta de schimbare parola profil utilizator
Route::get('/user/change/password', [IndexController::class, 'UserChangePassword'])->name('user.change.password');
// ruta de actualizare parola profil utilizator 
Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.profile.password.update');


// Admin Brand Rute Grupate si prefixate cu brand
Route::prefix('brand')->group(function () {
    // ruta pentru afisarea tuturor brandurilor
    Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');
    // ruta de inserare in tabela branduri
    Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
    // ruta de editare branduri din tabela brands
    Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
    // ruta de actualizare branduri din tabela brands
    Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');
    // ruta de stergere branduri din tabela brands
    Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
});


// Admin Categorii Rute Grupate si prefixate cu category
Route::prefix('category')->group(function () {
    // ruta pentru afisarea tuturor categoriilor
    Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');
    // ruta de inserare in tabela categories
    Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
    // ruta de editare categorii din tabela categories
    Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
    // ruta de actualizare categorii din tabela categories
    Route::post('/update', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
    // ruta de stergere categorii din tabela categories
    Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');

    // Admin Rute pentru Subcategorii 
    // ruta de afisare tuturor subcategoriilor
    Route::get('/subcategory/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.subcategory');
    // ruta de inserare in tabela subcategories
    Route::post('/subcategory/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
    // ruta de editare subcategorii din tabela subcategories
    Route::get('/subcategory/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
    // ruta de actualizare subcategorii din tabela subcategories
    Route::post('/subcategory/update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');
    // ruta de stergere subcategorii din tabela subcategories
    Route::get('/subcategory/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');

    // Admin Rute pentru SubSubcategorii 
    // ruta de afisare tuturor subsubcategoriilor
    Route::get('/subcategory/subcategory/view', [SubSubCategoryController::class, 'SubSubCategoryView'])->name('all.subsubcategory');
    // ruta de preluare subcategorie din tabela subcategories
    Route::get('/subcategory/subsubcategory/{category_id}', [SubSubCategoryController::class, 'GetSubCategory']);
    // ruta de preluare subsubcategorie din tabela subcategories
    Route::get('/subcategory/subsubcategory/product/{subcategory_id}', [SubSubCategoryController::class, 'GetSubSubCategory']);
    // ruta de inserare in tabela subsubcategories
    Route::post('/subcategory/subcategory/store', [SubSubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');
    // ruta de editare subsubcategorii din tabela subsubcategories
    Route::get('/subcategory/subcategory/edit/{id}', [SubSubCategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');
    // ruta de actualizare subcategorii din tabela subcategories
    Route::post('/subcategory/subcategory/update', [SubSubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');
    // ruta de stergere subsubcategorii din tabela subsubcategories
    Route::get('/subcategory/subcategory/delete/{id}', [SubSubCategoryController::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');
});

// Admin Produse Rute Grupate si prefixate cu product
Route::prefix('product')->group(function () {
    // ruta de afisare tuturor produselor
    Route::get('/add', [ProductController::class, 'AddProduct'])->name('add-product');
    // ruta de inserare in tabela products
    Route::post('/store', [ProductController::class, 'ProductStore'])->name('product-store');
    // ruta de vizualizare / management produse
    Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');
    // ruta de editare produse din tabela products
    Route::get('/edit/{id}', [ProductController::class, 'ProductEdit'])->name('product.edit');
    // ruta de actualizare produse din tabela products
    Route::post('/data/update', [ProductController::class, 'ProductDataUpdate'])->name('product-data-update');
    // ruta de actualizare multiImage produse
    Route::post('/multi-image/update', [ProductController::class, 'ProductMultiImageUpdate'])->name('product-multi-image-update');
    // ruta de actualizare poza principala produse
    Route::post('/thumbnail-image/update', [ProductController::class, 'ProductThumbnailImageUpdate'])->name('product-thumbnail-image-update');
    // ruta de stergere produse din tabela products
    Route::get('/multi-image/update/{id}', [ProductController::class, 'ProductMultiImageDelete'])->name('product-multi-image-delete');
    // ruta de dezactivare produse din tabela products
    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');
    // ruta de activare produse din tabela products
    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');
    // ruta de stergere produse din tabela products
    Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
});


// Admin Sliders Rute Grupate si prefixate cu slider
Route::prefix('slider')->group(function () {
    // ruta de afisare tuturor sliders
    Route::get('/view', [SliderController::class, 'SliderView'])->name('manage-slider');
    // ruta de inserare in tabela sliders
    Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');
    // ruta de editare sliders din tabela sliders
    Route::get('/edit/{id}', [SliderController::class, 'SliderEdit'])->name('slider.edit');
    // ruta de actualizare sliders din tabela sliders
    Route::post('/update', [SliderController::class, 'SliderUpdate'])->name('slider.update');
    // ruta de stergere sliders din tabela sliders
    Route::get('/delete/{id}', [SliderController::class, 'SliderDelete'])->name('slider.delete');
    // ruta de dezactivare sliders din tabela sliders
    Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');
    // ruta de activare sliders din tabela sliders
    Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');
});

// Rutele pentru pagina de detalii produse
// pagina frontend de detalii a unui produs
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);
// 2. Tag Wise Product Show Part 1
// Frontend Product Tag Page
Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);
// 1. SubCategory Wise Product Show
// 1. SubCategory Wise Product Show
// Frontend SubCategory wise Data
Route::get('/subcategory/product/{subcategory_id}/{slug}', [IndexController::class, 'SubCategoryWiseProduct']);
// 2. SubSubCategory Wise Product Show
// Frontend SubSubCategory wise Data
Route::get('/subsubcategory/product/{subsubcategory_id}/{slug}', [IndexController::class, 'SubSubCategoryWiseProduct']);
// 3. Product View Modal With Ajax Part 1
// Product View Modal with Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewModalAjax']);
