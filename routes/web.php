<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home');
});


#|--------------------------------------------------------------------------
#| Category Routes--- following [crud] controller.
#|--------------------------------------------------------------------------

# Reads category info from db and shows in view.
# Redirecting to [FUNCTION-NO::01]---in-controller.
Route::get('/show/all/categories','App\Http\Controllers\crud@show_category');

# Inserts category info into db.
# Redirecting to [FUNCTION-NO::02]---in-controller.
Route::post('/add/category','App\Http\Controllers\crud@insert_categories');

# Edits category from db.
# Redirecting to [FUNCTION-NO::03]---in-controller.
Route::post('/edit/category/{id}','App\Http\Controllers\crud@edit_categories');

# Deletes category from db.
# Redirecting to [FUNCTION-NO::04]---in-controller.
Route::get('/delete/category/{id}','App\Http\Controllers\crud@delete_categories');



#|--------------------------------------------------------------------------
#| List Routes--- following [crud] controller.
#|--------------------------------------------------------------------------

# Reads item info from db and shows in view.
# Redirecting to [FUNCTION-NO::05]---in-controller.
Route::get('/','App\Http\Controllers\crud@show_items');

# Inserts item info into db.
# Redirecting to [FUNCTION-NO::06]---in-controller.
Route::post('/add/item','App\Http\Controllers\crud@insert_items');

# Edit item from db.
# Redirecting to [FUNCTION-NO::07]---in-controller.
Route::post('/edit/item/{id}','App\Http\Controllers\crud@edit_items');

# Delete item from db.
# Redirecting to [FUNCTION-NO::08]---in-controller.
Route::get('/delete/item/{id}','App\Http\Controllers\crud@delete_items');