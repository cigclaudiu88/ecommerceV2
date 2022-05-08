<?php
//8. Laravel 8 Multi Auth Part 1
use App\Models\User;
//8. Laravel 8 Multi Auth Part 1

// 6. Admin Profile & Image Update Part 1
use Illuminate\Support\Facades\Auth;
// 6. Admin Profile & Image Update Part 1
// 1. Frontend Template Setup Part 2
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeBlogController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\ReviewController;
// 1. Frontend Template Setup Part 2
// 3. User Profile Design Part 3
use App\Http\Controllers\User\WishlistController;
// 3. User Profile Design Part 3
// 1. Brand Page Design Part 1
use App\Http\Controllers\Backend\SliderController;
// 1. Brand Page Design Part 1
// 1. Category Crud Part 1
use App\Http\Controllers\Frontend\IndexController;
// 1. Category Crud Part 1
// 5. Subcategory Crud Part 1
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\VoucherController;
// 5. Subcategory Crud Part 1
// 1. Add Product Database and Page Design Part 1
use App\Http\Controllers\Backend\CategoryController;
// 1. Add Product Database and Page Design Part 1
// 1. Upload Slider and Show All Slider List Part 1
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\SubSubCategoryController;
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
// ruta spre adrese livrare
Route::get('/user/profile/address', [IndexController::class, 'UserProfileAddress'])->name('user.address');
// ruta care preia in selectul localitatile din judetul selectat
Route::get('/user/profile/address/{state_id}', [IndexController::class, 'GetCity']);
// ruta de inserare adresa noua pentru utilizator
Route::post('/user/profile/address/store', [IndexController::class, 'UserProfileAddressStore'])->name('user.profile.address.store');
// ruta de actualizare adresa utilizator
Route::post('/user/profile/address/update/{id}', [IndexController::class, 'UserProfileAddressUpdate'])->name('user.profile.address.update');



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


// Admin Vouchers Rute Grupate si prefixate cu voucher
Route::prefix('voucher')->group(function () {
    // ruta de afisare tuturor voucher-urilor din tabelul vouchers
    Route::get('/view', [VoucherController::class, 'VoucherView'])->name('manage-voucher');
    // ruta de inserare voucher-uri in tabela vouchers
    Route::post('/store', [VoucherController::class, 'VoucherStore'])->name('voucher.store');
    // ruta de editare voucher-uri din tabela vouchers
    Route::get('/edit/{id}', [VoucherController::class, 'VoucherEdit'])->name('voucher.edit');
    // ruta de actualizare voucher-uri din tabela vouchers
    Route::post('/update/{id}', [VoucherController::class, 'VoucherUpdate'])->name('voucher.update');
    // ruta de stergere voucher-uri din tabela vouchers
    Route::get('/delete/{id}', [VoucherController::class, 'VoucherDelete'])->name('voucher.delete');
});

// Rutele pentru pagina de detalii produse
// pagina frontend de detalii a unui produs
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);
// Frontend Product Tag Page
Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);
// ruta de afisare a produselor functie de subcategorie
Route::get('/subcategory/product/{subcategory_id}/{slug}', [IndexController::class, 'SubCategoryWiseProduct']);
// ruta de afisare a produselor functie de subsubcategorie
Route::get('/subsubcategory/product/{subsubcategory_id}/{slug}', [IndexController::class, 'SubSubCategoryWiseProduct']);
// ruta de afisare a produselor in modal cu script ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewModalAjax']);
// ruta de aduagat in cosul de cumparaturi script ajax
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);
// ruta pt afisare ini mini cosul de cumparaturi
Route::get('/product/mini/cart/', [CartController::class, 'AddMiniCart']);
// ruta de stergere produse din minicart
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);
// ruta pentru adaugare produse in wishlist
Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'AddToWishlist']);
// grupare rutele pt wishlist si prefixate cu wishlist si folosind middleware user
Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function () {
    // ruta spre pagina de wishlist
    Route::get('/wishlist', [WishlistController::class, 'ViewWishlist'])->name('wishlist');
    // ruta de preluare a produselor din wishlist
    Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct']);
    // ruta de stergere produse din wishlist
    Route::get('/wishlist-remove/{id}', [WishlistController::class, 'RemoveWishlistProduct']);
    // rupta pt plata cu cardul stripe
    Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order');
    // ruta pt plata comanda cu cash
    Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');
    // ruta pt vizualizare comenzile in user dashboard
    Route::get('/my/orders', [AllUserController::class, 'MyOrders'])->name('my.orders');
    // ruta pt vizualizare detalii comanda in user dashboard
    Route::get('/order_details/{order_id}', [AllUserController::class, 'OrderDetails']);
    // ruta pt descarcare factura din user dashboard
    Route::get('/invoice_download/{order_id}', [AllUserController::class, 'InvoiceDownload']);
    // ruta retur comanda - user dashboard
    Route::post('/return/order/{order_id}', [AllUserController::class, 'ReturnOrder'])->name('return.order');
    // ruta afisare comenzi returnate - user dashboar
    Route::get('/return/order/list', [AllUserController::class, 'ReturnOrderList'])->name('return.order.list');
    // ruta pt vizualizare comenzi anulate - user dashboard
    Route::get('/cancel/orders', [AllUserController::class, 'CancelOrders'])->name('cancel.orders');
});
// ruta spre pagina cosului de cumparaturi
Route::get('/user/mycart', [CartPageController::class, 'MyCart'])->name('mycart');
// ruta care aduce produseles din cosul de cumparaturi
Route::get('/user/get-cart-product', [CartPageController::class, 'GetCartProduct']);
// ruta de stergere produse din pagina cosului de cumparaturi
Route::get('/user/cart-remove/{rowId}', [CartPageController::class, 'RemoveCartProduct']);
// ruta de crestere cantitatea produselor din cosul de cumparaturi
Route::get('/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']);
// ruta de scadere cantitatea produselor din cosul de cumparaturi
Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);

// Rute zona de expedieri
Route::prefix('shipping')->group(function () {
    // ruta de afisare a zonelor de expediere
    Route::get('/division/view', [ShippingAreaController::class, 'DivisionView'])->name('manage-division');
    // ruta de inserare a zonelor de expediere
    Route::post('/division/store', [ShippingAreaController::class, 'DivisionStore'])->name('division.store');
    // ruta de editare a zonelor de expediere
    Route::get('/division/edit/{id}', [ShippingAreaController::class, 'DivisionEdit'])->name('division.edit');
    // ruta de actualizare a zonelor de expediere
    Route::post('/division/update/{id}', [ShippingAreaController::class, 'DivisionUpdate'])->name('division.update');
    // ruta de stergere a zonelor de expediere
    Route::get('/division/delete/{id}', [ShippingAreaController::class, 'DivisionDelete'])->name('division.delete');

    // Ship District 
    Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('manage-district');

    Route::post('/district/store', [ShippingAreaController::class, 'DistrictStore'])->name('district.store');

    Route::get('/district/edit/{id}', [ShippingAreaController::class, 'DistrictEdit'])->name('district.edit');

    Route::post('/district/update/{id}', [ShippingAreaController::class, 'DistrictUpdate'])->name('district.update');

    Route::get('/district/delete/{id}', [ShippingAreaController::class, 'DistrictDelete'])->name('district.delete');
});

// ruta de aplicare voucher
Route::post('/voucher-apply', [CartController::class, 'VoucherApply']);
// ruta de calculare valoare voucher din cosu lde cumparaturi
Route::get('/voucher-calculation', [CartController::class, 'VoucherCalculation']);
// ruta de stergere voucher din cosul de cumparaturi 
Route::get('/voucher-remove', [CartController::class, 'VoucherRemove']);

// ruta spre casa de vanzari 
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
// ruta pentru preluare localitate din judet pt pagina de casa -> adresa livrare
Route::get('/district-get/ajax/{division_id}', [CheckoutController::class, 'DistrictGetAjax']);
// ruta pentru preluare date adresa pagina de casa -> adresa livrare
Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');

// Admin Rute Comenzi
Route::prefix('orders')->group(function () {
    // ruta de vizualizare comenzi in asteptare in admin dashboard
    Route::get('/pending/orders', [OrderController::class, 'PendingOrders'])->name('pending-orders');
    // ruta de vizualizare detalii comenzi in asteptare in admin dashboard
    Route::get('/pending/orders/details/{order_id}', [OrderController::class, 'PendingOrdersDetails'])->name('pending.order.details');
    // ruta de vizualizare detalii comenzi confirmate in admin dashboard
    Route::get('/confirmed/orders', [OrderController::class, 'ConfirmedOrders'])->name('confirmed-orders');
    // ruta de vizualizare detalii comenzi in procesare in admin dashboard
    Route::get('/processing/orders', [OrderController::class, 'ProcessingOrders'])->name('processing-orders');
    // ruta de vizualizare detalii comenzi preluate de curier in admin dashboard
    Route::get('/picked/orders', [OrderController::class, 'PickedOrders'])->name('picked-orders');
    // ruta de vizualizare detalii comenzi in tranzit in admin dashboard
    Route::get('/shipped/orders', [OrderController::class, 'ShippedOrders'])->name('shipped-orders');
    // rula de vizualizare detalii comenzi livrate in admin dashboard
    Route::get('/delivered/orders', [OrderController::class, 'DeliveredOrders'])->name('delivered-orders');
    // ruta de vizualizare detalii comenzi anulate in admin dashboard
    Route::get('/cancel/orders', [OrderController::class, 'CancelOrders'])->name('cancel-orders');
    // ruta de modificare status comanda din "In asteptare" -> "Confirmata"
    Route::get('/pending/confirm/{order_id}', [OrderController::class, 'PendingToConfirm'])->name('pending-confirm');
    // ruta de modificare status comanda din "Confirmata" -> "Procesata"
    Route::get('/confirm/processing/{order_id}', [OrderController::class, 'ConfirmToProcessing'])->name('confirm.processing');
    // ruta de modificare status comanda din "Procesata" -> "Preluata de curier"
    Route::get('/processing/picked/{order_id}', [OrderController::class, 'ProcessingToPicked'])->name('processing.picked');
    // ruta de modificare status comanda din "Preluata de curier" -> "In tranzit"
    Route::get('/picked/shipped/{order_id}', [OrderController::class, 'PickedToShipped'])->name('picked.shipped');
    // ruta de modificare status comanda din "In tranzit" -> "Livrata"
    Route::get('/shipped/delivered/{order_id}', [OrderController::class, 'ShippedToDelivered'])->name('shipped.delivered');
    // ruta de modificare status comanda din "Livrata" -> "Anulata"
    Route::get('/shipped/delivered/canceled/{order_id}', [OrderController::class, 'DeliveredToCanceled'])->name('delivered.canceled');
    // ruta pentru descarcat factura PDF in admin dashboard din pagina comenzi confirmate
    Route::get('/invoice/download/{order_id}', [OrderController::class, 'AdminInvoiceDownload'])->name('invoice.download');
});

// Admin Rute pentru Rapoarte 
Route::prefix('reports')->group(function () {
    // ruta pentru vizualizare pagina selectare raport vanzari in admin dashboard
    Route::get('/view', [ReportController::class, 'ReportView'])->name('all-reports');
    // ruta pt vizualizare raport vanzari in admin dashboard pe zi
    Route::post('/search/by/date', [ReportController::class, 'ReportByDate'])->name('search-by-date');
    // ruta pt vizualizare raport vanzari in admin dashboard pe luna si an
    Route::post('/search/by/month', [ReportController::class, 'ReportByMonth'])->name('search-by-month');
    // ruta pt vizualizare raport vanzari in admin dashboard pe an
    Route::post('/search/by/year', [ReportController::class, 'ReportByYear'])->name('search-by-year');
});

// Admin rute vizualizare utilizatori
Route::prefix('alluser')->group(function () {
    // ruta de vizualizare utilizatori in admin dashboard
    Route::get('/view', [AdminProfileController::class, 'AllUsers'])->name('all-users');
});

// Admin rute pt sectiunea de blog 
Route::prefix('blog')->group(function () {
    // ruta pentru vizualizare sectiunea de categorii de blog in admin dashboard
    Route::get('/category', [BlogController::class, 'BlogCategory'])->name('blog.category');
    // ruta pentru inserare categorie postare blog in tabelul blog_categories
    Route::post('/store', [BlogController::class, 'BlogCategoryStore'])->name('blogcategory.store');
    // ruta pentru editare categorie postare blog in tabelul blog_categories
    Route::get('/category/edit/{id}', [BlogController::class, 'BlogCategoryEdit'])->name('blog.category.edit');
    // ruta pentru actualizare categorie postare blog in tabelul blog_categories
    Route::post('/update/{id}', [BlogController::class, 'BlogCategoryUpdate'])->name('blog.category.update');
    // ruta pentru stergere categorie postare blog in tabelul blog_categories
    Route::get('/category/delete/{id}', [BlogController::class, 'BlogCategoryDelete'])->name('blog.category.delete');
    // ruta de adaugare postare blog in admin dashboard
    Route::get('/add/post', [BlogController::class, 'AddBlogPost'])->name('add.post');
    // ruta de vizualizare lista postari blog in admin dashboard
    Route::get('/list/post', [BlogController::class, 'ListBlogPost'])->name('list.post');
    // ruta de inserare postare blog in tabelul blog_posts in admin dashboard
    Route::post('/post/store', [BlogController::class, 'BlogPostStore'])->name('post.store');
    // ruta de editare postare blog din tabelul blog_posts in admin dashboard
    Route::get('/post/edit/{id}', [BlogController::class, 'BlogPostEdit'])->name('post.edit');
    // ruta de actualizare postare blog din tabelul blog_posts in admin dashboard
    Route::post('/post/update', [BlogController::class, 'BlogPostUpdate'])->name('post.update');
    // ruta de stergere postare blog din tabelul blog_posts in admin dashboard
    Route::get('/post/delete/{id}', [BlogController::class, 'BlogPostDelete'])->name('post.delete');
});

// ruta Frontend Afisare Blog
Route::get('/blog', [HomeBlogController::class, 'AddBlogPost'])->name('home.blog');
// ruta frontend Afisare Postare Blog Detalii
Route::get('/post/details/{id}', [HomeBlogController::class, 'DetailsBlogPost'])->name('post.details');
// ruta filtrare postari blog dupa categorie - frontend
Route::get('/blog/category/post/{category_id}', [HomeBlogController::class, 'HomeBlogCatPost']);


// Admin rute pentru sectiunea setari site
Route::prefix('setting')->group(function () {
    // ruta de directionare spre pagina de actualizare date companie site
    Route::get('/site', [SiteSettingController::class, 'SiteSetting'])->name('site.setting');
    // functia de actualizare date companie site in admin dashboard
    Route::post('/site/update', [SiteSettingController::class, 'SiteSettingUpdate'])->name('update.site.setting');
    // ruta pentru SEO in admin dashboard
    Route::get('/seo', [SiteSettingController::class, 'SeoSetting'])->name('seo.setting');
    // functia de actualizare SEO in admin dashboard
    Route::post('/seo/update', [SiteSettingController::class, 'SeoSettingUpdate'])->name('update.seo.setting');
});


// Admin rute retur comenzi
Route::prefix('return')->group(function () {
    // ruta de vizualizare retururi in admin dashboard
    Route::get('/admin/request', [ReturnController::class, 'ReturnRequest'])->name('return.request');
    // ruta pentru aprobare retur comanda in admin dashboard
    Route::get('/admin/return/approve/{order_id}', [ReturnController::class, 'ReturnRequestApprove'])->name('return.approve');
    // ruta de viauzliare toate returuile in admin dashboard
    Route::get('/admin/all/request', [ReturnController::class, 'ReturnAllRequest'])->name('all.request');
    // ruta pentru aprobare retur comanda in admin dashboard
    Route::get('/admin/return/item/approve/{order_item_id}', [ReturnController::class, 'ReturnItemRequestApprove'])->name('return.item.approve');
    // ruta pentru aprobare retur comanda in admin dashboard
    Route::get('/admin/return/item/finalized/{order_item_id}', [ReturnController::class, 'ReturnItemFinalized'])->name('return.item.finalized');
});

// Rute Recenzii User - Frontend
// ruta pentru salvare recenzii user in tabelul reviews
Route::post('/review/store', [ReviewController::class, 'ReviewStore'])->name('review.store');
// Rute Recenzii - Admin Dashboard 
Route::prefix('review')->group(function () {
    // ruta de vizualizare recenzii in asteptare in admin dashboard
    Route::get('/pending', [ReviewController::class, 'PendingReview'])->name('pending.review');
    // ruta de vizualizare detalii recenzii in admin dashboard
    Route::get('/pending/details/{id}', [ReviewController::class, 'PendingReviewDetails'])->name('pending.review.details');
    // ruta de aprobare recenzii in admin dashboard
    Route::get('/admin/approve/{id}', [ReviewController::class, 'ReviewApprove'])->name('review.approve');
    // ruta de vizualizare toate recenziile
    Route::get('/admin/all/request', [ReturnController::class, 'ReturnAllRequest'])->name('all.request');
    // ruta de vizualizare recenzii  publicate in admin dashboard
    Route::get('/publish', [ReviewController::class, 'PublishReview'])->name('publish.review');
    // ruta de stergere recenzii in admin dashboard
    Route::get('/delete/{id}', [ReviewController::class, 'DeleteReview'])->name('delete.review');
});