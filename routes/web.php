<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\DependentDropdown;
use App\Http\Controllers\AuthController;



// Route::get('/', function () {
//     return view('home');
// });


Route::group(['middleware'=>['accountAuth']],function() {

#|--------------------------------------------------------------------------
#| Category Routes--- following [CategoryController] controller.
#|--------------------------------------------------------------------------

# Reads category info from db and shows in view.
Route::get('/show/all/categories', [CategoryController::class, 'index'])->name('index');

# Inserts category info into db.
Route::post('/add/category', [CategoryController::class, 'create'])->name('create');

# Brings data to form for edit.
Route::get('/edit/category/{id}', [CategoryController::class, 'edit'])->name('edit');

# Edits category info from db.
Route::post('/edit/category/{id}', [CategoryController::class, 'update'])->name('update');

# Deletes category from db.
Route::get('/delete/category/{id}', [CategoryController::class, 'destroy'])->name('destroy');



#|--------------------------------------------------------------------------
#| Sub Category Routes--- following [SubCategoryController] controller.
#|--------------------------------------------------------------------------

# Reads sub category info from db and shows in view.
Route::get('/show/all/sub/categories', [SubCategoryController::class, 'index'])->name('indexSub');

# Inserts sub category info into db.
Route::post('/add/sub/category', [SubCategoryController::class, 'create'])->name('createSub');

# Brings data to form for edit.
Route::get('/edit/sub/category/{id}', [SubCategoryController::class, 'edit'])->name('editSub');

# Edits sub category info from db.
Route::post('/edit/sub/category/{id}', [SubCategoryController::class, 'update'])->name('updateSub');

# Deletes sub category from db.
Route::get('/delete/sub/category/{id}', [SubCategoryController::class, 'destroy'])->name('destroySub');



#|--------------------------------------------------------------------------
#| Product Routes--- following [ProductController] controller.
#|--------------------------------------------------------------------------

# Show product add form.
Route::get('/insert/product', [ProductController::class, 'index'])->name('indexPro');

# Inserts product info into db.
Route::post('/add/product', [ProductController::class, 'create'])->name('createPro');

# Edit product from db.
Route::post('/edit/product/{id}', [ProductController::class, 'update'])->name('updatePro');



#|--------------------------------------------------------------------------
#| Product List Routes--- following [ProductListController] controller.
#|--------------------------------------------------------------------------

# Reads product info from db and shows in view.
Route::get('/show/all/products', [ProductListController::class, 'index'])->name('indexProList');

# Edit product from db.
Route::get('/edit/product/{id}', [ProductListController::class, 'edit'])->name('editProList');

# Delete product from db.
Route::get('/delete/product/{id}', [ProductListController::class, 'destroy'])->name('destroyProList');



#|--------------------------------------------------------------------------
#| Gallery Routes--- following [GalleryController] controller.
#|--------------------------------------------------------------------------

# Delete gallery image.
Route::get('/delete/image/{id}', [GalleryController::class, 'destroy'])->name('destroyGallery');




#|--------------------------------------------------------------------------
#| Attribute Routes--- following [AttributeController] controller.
#|--------------------------------------------------------------------------

# Delete attribute.
Route::get('/delete/attribute/{id}', [AttributeController::class, 'destroy'])->name('destroyAttribute');


#|--------------------------------------------------------------------------
#| Dependent sub category Routes--- following [DependentDropdown] controller.
#|--------------------------------------------------------------------------

# Delete attribute.
Route::post('/get/dependent/sub/category', [DependentDropdown::class, 'index'])->name('indexDependent');

});

#|--------------------------------------------------------------------------
#| Auth Routes--- following [AuthController] controller.
#|--------------------------------------------------------------------------

# Login page.
Route::get('/', [AuthController::class, 'login'])->name('login');

# Register page.
Route::get('/register', [AuthController::class, 'register'])->name('register');

# Register user.
Route::post('/register/user', [AuthController::class, 'registerUser'])->name('registerUser');

# Login user.
Route::post('/login/user', [AuthController::class, 'loginUser'])->name('loginUser');

# Verify user.
Route::get('/verify/account/{token}', [AuthController::class, 'verifyUser'])->name('verifyUser');

# Logout user.
Route::get('/logout', function () {
    session()->forget('access');
    return redirect('/');
});