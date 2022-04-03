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
    // 3. User Profile Design Part 3
    // $id takes the id DB value for authenticated user
    $id = Auth::user()->id;
    // $user finds the $id in the User Model
    $user = User::find($id);
    return view('dashboard', compact('user'));
    // 3. User Profile Design Part 3
})->name('dashboard');
// Home Page route
// 1. Frontend Template Setup Part 1
// frontpage home route
Route::get('/', [IndexController::class, 'index']);
// 1. Frontend Template Setup Part 1
// 2. User Profile Design Part 2
// ruta de logout utlizator
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
// ruta de date profil  - momentan inactiva - totul merge prin /dashboard
Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
// 2. User Profile Design Part 2
// 2. User Profile Design Part 3
Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
// 2. User Profile Design Part 3
// 5. User Profile¦ Password Change Part 1
Route::get('/user/change/password', [IndexController::class, 'UserChangePassword'])->name('user.change.password');
// 5. User Profile¦ Password Change Part 1
// 5. User Profile¦ Password Change Part 2
Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.profile.password.update');
// 5. User Profile¦ Password Change Part 2

// Admin Brand All Routes Group
// 1. Brand Page Design Part 1
Route::prefix('brand')->group(function () {
    // Display All Brands Route
    Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');
    // 3. Brand Page Design Part 3
    // Brand Store route
    Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
    // 3. Brand Page Design Part 3
    // 7. Brand Crud Part 2
    // Edit Brand Route
    Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
    // Update Brand Route
    Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');
    // 7. Brand Crud Part 2
    // 8. Brand Crud Part 3 Delete With Sweelalert Alert 2 
    // Brand Delete Route
    Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
    // 8. Brand Crud Part 3 Delete With Sweelalert Alert 2
});
// 1. Brand Page Design Part 1

// Admin Category All Routes Group
// 1. Category Crud Part 1
Route::prefix('category')->group(function () {
    // Display All Category Route
    Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');
    // 2. Category Crud Part 2
    // Category Store route
    Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
    // 2. Category Crud Part 2
    // 3. Category Crud Part 3
    // Edit Category Route
    Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
    // Update Category Route
    Route::post('/update', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
    // 3. Category Crud Part 3
    // 4. Category Crud Part 4
    // Category Delete Route
    Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');
    // 4. Category Crud Part 4
    // 1. Category Crud Part 1

    // All Admin SubCategory All Routes

    // Display All SubCategory Route
    // 5. Subcategory Crud Part 1
    Route::get('/subcategory/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.subcategory');

    // 6. Subcategory Crud Part 2
    // Category Store route
    Route::post('/subcategory/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
    // 6. Subcategory Crud Part 2

    // 6. Subcategory Crud Part 2
    // Edit Category Route
    Route::get('/subcategory/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
    // 6. Subcategory Crud Part 2

    // 7. Subcategory Crud Part 3
    // Update Category Route
    Route::post('/subcategory/update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');
    // 7. Subcategory Crud Part 3

    // Category Delete Route
    Route::get('/subcategory/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');
    // 7. Subcategory Crud Part 3
    // 5. Subcategory Crud Part 1

    // All Admin Sub->SubCategory All Routes
    // 1. Sub Subcategory Crud Part 1
    // SubSubCategories View Route
    Route::get('/subcategory/subcategory/view', [SubCategoryController::class, 'SubSubCategoryView'])->name('all.subsubcategory');
    // 1. Sub Subcategory Crud Part 1

    // 1. Sub Subcategory Crud Part 2
    // SubSubCategories GetCategory Route
    Route::get('/subcategory/subsubcategory/{category_id}', [SubCategoryController::class, 'GetSubCategory']);
    // 1. Sub Subcategory Crud Part 2

    // 4. Add Product Database and Page Design Part 4
    Route::get('/subcategory/subsubcategory/product/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);
    // 4. Add Product Database and Page Design Part 4

    // 1. Sub Subcategory Crud Part 3
    // SubSubCategories Insert Route
    Route::post('/subcategory/subcategory/store', [SubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');
    // 1. Sub Subcategory Crud Part 3

    // 4. Sub Subcategory Crud Part 4
    // SubSubCategories Edit Route
    Route::get('/subcategory/subcategory/edit/{id}', [SubCategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');
    // SubSubCategories Update Route
    Route::post('/subcategory/subcategory/update', [SubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');
    // 4. Sub Subcategory Crud Part 4

    // 4. Sub Subcategory Crud Part 5
    // SubSubCategory Delete Route
    Route::get('/subcategory/subcategory/delete/{id}', [SubCategoryController::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');
    // 4. Sub Subcategory Crud Part 5
});

// 1. Add Product Database and Page Design Part 1
// All Admin Products All Route
Route::prefix('product')->group(function () {
    // Display All Brands Route
    Route::get('/add', [ProductController::class, 'AddProduct'])->name('add-product');
    // 8. Product Upload Part 2
    Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product-store');
    // 8. Product Upload Part 2
    // 10. Manage Product Read All Product
    Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');
    // 10. Manage Product Read All Product
    // 11. Manage Product Edit Option Part 1
    Route::get('/edit/{id}', [ProductController::class, 'ProductEdit'])->name('product.edit');
    // 11. Manage Product Edit Option Part 1
    // 13. Manage Product Update Option
    Route::post('/data/update', [ProductController::class, 'ProductDataUpdate'])->name('product-data-update');
    // 13. Manage Product Update Option
    // 15. Manage Product Update Single & Multiple Image Part 2
    Route::post('/multi-image/update', [ProductController::class, 'ProductMultiImageUpdate'])->name('product-multi-image-update');
    // 15. Manage Product Update Single & Multiple Image Part 2

    // 15. Manage Product Update Single & Multiple Image Part 3
    Route::post('/thumbnail-image/update', [ProductController::class, 'ProductThumbnailImageUpdate'])->name('product-thumbnail-image-update');
    // 15. Manage Product Update Single & Multiple Image Part 3
    // 17. Multiple image Delete
    Route::get('/multi-image/update/{id}', [ProductController::class, 'ProductMultiImageDelete'])->name('product-multi-image-delete');
    // 17. Multiple image Delete

    // Add Active / Inactive Product Functionality
    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');

    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');
    // Add Active / Inactive Product Functionality
    // 19. Product Delete With Multiple Image
    Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
    // 19. Product Delete With Multiple Image
});
// 1. Add Product Database and Page Design Part 1

// Admin Slider All Routes
// 1. Slider Page Design Part 1
Route::prefix('slider')->group(function () {
    // Display All Slider Route
    Route::get('/view', [SliderController::class, 'SliderView'])->name('manage-slider');
    // 1. Slider Page Design Part 1
    // 2. Upload Slider and Show All Slider List Part 2
    // Slider Store route
    Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');
    // 2. Upload Slider and Show All Slider List Part 2
    // Edit Slider Route
    // 3. Slider Edit & Update Delete Part 1
    Route::get('/edit/{id}', [SliderController::class, 'SliderEdit'])->name('slider.edit');
    // Update Slider Route
    Route::post('/update', [SliderController::class, 'SliderUpdate'])->name('slider.update');
    // 3. Slider Edit & Update Delete Part 1
    // 4. Slider Edit & Update Delete Part 2
    // Delete Slider Route
    Route::get('/delete/{id}', [SliderController::class, 'SliderDelete'])->name('slider.delete');
    // 4. Slider Edit & Update Delete Part 2
    // 5. Slider Active Inactive
    Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');

    Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');
    // 5. Slider Active Inactive
});
// 1. Brand Page Design Part 1

// 1. Product Details Show Part 1
// Frontend - Product Details Page URL
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
