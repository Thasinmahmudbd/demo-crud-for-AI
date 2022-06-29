<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryController;



// Route::get('/', function () {
//     return view('home');
// });


#|--------------------------------------------------------------------------
#| Category Routes--- following [categoryController] controller.
#|--------------------------------------------------------------------------

# Reads category info from db and shows in view.
Route::get('/show/all/categories','App\Http\Controllers\categoryController@index')->name('index');

# Inserts category info into db.
Route::post('/add/category','App\Http\Controllers\categoryController@create')->name('create');

# Brings data to form for edit.
Route::get('/edit/category/{id}','App\Http\Controllers\categoryController@edit')->name('edit');

# Edits category info from db.
Route::post('/edit/category/{id}','App\Http\Controllers\categoryController@update')->name('update');

# Deletes category from db.
Route::get('/delete/category/{id}','App\Http\Controllers\categoryController@destroy')->name('destroy');



#|--------------------------------------------------------------------------
#| Sub Category Routes--- following [subCategoryController] controller.
#|--------------------------------------------------------------------------

# Reads sub category info from db and shows in view.
Route::get('/show/all/sub/categories','App\Http\Controllers\subCategoryController@index')->name('indexSub');

# Inserts sub category info into db.
Route::post('/add/sub/category','App\Http\Controllers\subCategoryController@create')->name('createSub');

# Brings data to form for edit.
Route::get('/edit/sub/category/{id}','App\Http\Controllers\subCategoryController@edit')->name('editSub');

# Edits sub category info from db.
Route::post('/edit/sub/category/{id}','App\Http\Controllers\subCategoryController@update')->name('updateSub');

# Deletes sub category from db.
Route::get('/delete/sub/category/{id}','App\Http\Controllers\subCategoryController@destroy')->name('destroySub');



#|--------------------------------------------------------------------------
#| Product Routes--- following [productController] controller.
#|--------------------------------------------------------------------------

# Show product add form.
Route::get('/','App\Http\Controllers\productController@index')->name('indexPro');

# Inserts product info into db.
Route::post('/add/product','App\Http\Controllers\productController@create')->name('createPro');

# Edit product from db.
Route::post('/edit/product/{id}','App\Http\Controllers\productController@update')->name('updatePro');



#|--------------------------------------------------------------------------
#| Product List Routes--- following [productListController] controller.
#|--------------------------------------------------------------------------

# Reads product info from db and shows in view.
Route::get('/show/all/products','App\Http\Controllers\productListController@index')->name('indexProList');

# Edit product from db.
Route::get('/edit/product/{id}','App\Http\Controllers\productListController@edit')->name('editProList');

# Delete product from db.
Route::get('/delete/product/{id}','App\Http\Controllers\productListController@destroy')->name('destroyProList');



#|--------------------------------------------------------------------------
#| Gallery Routes--- following [galleryController] controller.
#|--------------------------------------------------------------------------

# Delete gallery image.
Route::get('/delete/image/{id}','App\Http\Controllers\galleryController@destroy')->name('destroyGallery');




#|--------------------------------------------------------------------------
#| Attribute Routes--- following [attributeController] controller.
#|--------------------------------------------------------------------------

# Delete attribute.
Route::get('/delete/attribute/{id}','App\Http\Controllers\attributeController@destroy')->name('destroyAttribute');