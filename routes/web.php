<?php

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CatagoryController;
// use App\Http\Controllers\RubelController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;


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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('backend.dashboard');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');




// frontend
Route::get('/',[FrontendController::class,'frontend'])->name('frontend');
Route::get('product-details/{product}',[FrontendController::class,'productDetails'])->name('productDetails');
Route::get('/get/sizecolor-details/{color_id}/{product_id}',[FrontendController::class,'sizecolordetails'])->name('sizecolordetails');

// cart
// view cart
Route::get('view-cart',[CartController::class,'viewcart'])->name('viewcart');



// dashboard
Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
// Route::get('catagories',[CatagoryController::class,'catagories'])->name('catagories');




// category
// view catagory
Route::get('view-catagory',[CatagoryController::class,'catagory'])->name('catagory');
// Add catgory
Route::get('add-catagory',[CatagoryController::class,'addcatagory'])->name('addcatagory');
// catagory save into database table 
Route::post('post-catagory',[CatagoryController::class,'postcatagory'])->name('postcatagory');
// delete catagory
Route::get('delete-catagory/{cat}',[CatagoryController::class,'deletecatagory'])->name('deletecatagory');
// Update catagory
Route::get('update-catagory/{cat}',[CatagoryController::class,'updatecatagory'])->name('updatecatagory');
Route::post('updated-catagory',[CatagoryController::class,'updatedcatagory'])->name('updatedcatagory');
// trashed catagory view
Route::get('trashed-catagory',[CatagoryController::class,'trashedcatagory'])->name('trashedcatagory');
// trashed catagory restore
Route::get('restore-catagory/{id}',[CatagoryController::class,'restorecatagory'])->name('restorecatagory');
// trashed catagory permanent delete
Route::get('permanent-delete-catagory/{id}',[CatagoryController::class,'permanentdeletecatagory'])->name('permanentdeletecatagory');






// Subcategory
// view SubCategory
Route::get('view-subcategory',[SubCategoryController::class,'subcategory'])->name('subcategory');
// Add sub catgory
Route::get('add-subcatagory',[SubCategoryController::class,'addsubcatagory'])->name('addsubcatagory');
// sub catagory save into database table 
Route::post('post-subcategory',[SubCategoryController::class,'postsubcategory'])->name('postsubcategory');
// delete sub category
Route::get('delete-subCategory/{cat}',[SubCategoryController::class,'deletesubategory'])->name('deletesubategory');
// Update sub catagory
Route::get('update-subcategory/{cat}',[SubCategoryController::class,'updatesubcategory'])->name('updatesubcategory');
Route::post('updated-subcategory',[SubCategoryController::class,'updatedsubcategory'])->name('updatedsubcategory');
// trashed sub catagory view
Route::get('trashed-subcategory',[SubCategoryController::class,'trashedsubcategory'])->name('trashedsubcategory');
// trashed sub catagory restore
Route::get('restore-subcategory/{id}',[SubCategoryController::class,'restoresubcategory'])->name('restoresubcategory');
// trashed sub catagory permanent delete
Route::get('permanentdelete-catagory/{id}',[SubCategoryController::class,'permanentdeletecatagory'])->name('permanentdeletecatagory');
// multiple sub catagory delete
Route::post('delete-all-subcategory',[SubCategoryController::class,'deleteallsubcategory'])->name('deleteallsubcategory');
// // multiple trashed catagory restore
Route::post('restore-all-subcategory',[SubCategoryController::class,'restoreallsubcategory'])->name('restoreallsubcategory');
// // multiple trashed catagory restore
Route::post('restore-all-subcategory',[SubCategoryController::class,'restoreallsubcategory'])->name('restoreallsubcategory');
// permanently delete selected sub catagory
Route::post('permanently-delete-all-subcategory',[SubCategoryController::class,'permanentlyDeleteAllSubcategory'])->name('permanentlyDeleteAllSubcategory');
require __DIR__.'/auth.php';
Route::get('add-products',[ProductController::class,'addproducts'])->name('addproducts');
// subcatagory ajax
Route::get('get-sub-catagory/{id}', [ProductController::class, 'ajaxsubcat'])->name('ajaxsubcat');




// product
// Save products into database
Route::post('post-products',[ProductController::class,'postProducts'])->name('postProducts');
// View Products
Route::get('view-products',[ProductController::class,'viewProducts'])->name('viewProducts');
// delete Product
Route::get('delete-Product/{productid}',[ProductController::class,'deleteProduct'])->name('deleteProduct');
// Update product
Route::get('edit-product/{slug}',[ProductController::class,'editProduct'])->name('editProduct');
Route::post('updated-product',[ProductController::class,'updatedproduct'])->name('updatedproduct');
// trashed products view
Route::get('trashed-Product',[ProductController::class,'trashedProduct'])->name('trashedProduct');
// trashed products restore
Route::get('restore-Product/{id}',[ProductController::class,'restoreProduct'])->name('restoreProduct');
// trashed products permanent delete
Route::get('permanently-delete-Product/{id}',[ProductController::class,'permanentlyDeleteProduct'])->name('permanentlyDeleteProduct');
// multiple sub catagory delete
Route::post('delete-all-Products',[ProductController::class,'deleteallProducts'])->name('deleteallProducts');
// delete attribute from product update
Route::get('/attribute/delete/{attribute_id}',[ProductController::class,'deleteattribute'])->name('deleteattribute');
// delete single image from product update
Route::get('delete/single/image/{id}',[ProductController::class,'delete_single_image'])->name('delete_single_image');





// color 
// view color
Route::get('view-color',[ColorController::class,'color'])->name('color');
// Add color
Route::get('add-color',[ColorController::class,'addcolor'])->name('addcolor');
// color save into database table 
Route::post('post-color',[ColorController::class,'postcolor'])->name('postcolor');




// size 
// view size
Route::get('view-size',[SizeController::class,'size'])->name('size');
// Add size
Route::get('add-size',[SizeController::class,'addsize'])->name('addsize');
// size save into database table 
Route::post('post-size',[SizeController::class,'postsize'])->name('postsize');
