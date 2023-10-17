<?php

use App\Http\Controllers\OverCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomePageController::class, 'index'])->name('homepage');
Route::get('/product/{id}', [\App\Http\Controllers\HomePageController::class, 'showProduct'])->name('showProduct');

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout')->middleware('auth');
Route::post('/login/success', [\App\Http\Controllers\LoginController::class, 'login'])->name('adminlogin')->middleware('guest');

Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register/user', [\App\Http\Controllers\RegisterController::class, 'registerUser'])->name('register_user')->middleware('guest');
Route::get('/register/company', [\App\Http\Controllers\CompanyController::class, 'index'])->name('register_company');
Route::post('/register/company/register', [\App\Http\Controllers\CompanyController::class, 'registerCompany'])->name('register_user_company')->middleware('auth');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class,'index'])->name('dashboard')->middleware('auth');
Route::get('/dashboard/user/{id}', [\App\Http\Controllers\DashboardController::class,'userSetting'])->name('user_settings')->middleware('auth');
Route::post('/dashboard/user/{id}/update', [\App\Http\Controllers\DashboardController::class,'userUpdate'])->name('user_settings_update')->middleware('auth');
Route::get('/dashboard/company/{id}', [\App\Http\Controllers\DashboardController::class,'companySetting'])->name('company_settings')->middleware('auth');
Route::post('/dashboard/company/{id}/update', [\App\Http\Controllers\DashboardController::class,'companySettingUpdate'])->name('company_settings_update')->middleware('auth');
Route::get('/dashboard/settings', [\App\Http\Controllers\SettingController::class, 'index'])->name('settings')->middleware('auth');
Route::get('/dashboard/apps', [\App\Http\Controllers\AppController::class, 'index'])->name('apps')->middleware('auth');
Route::get('/dashboard/apps/{id}', [\App\Http\Controllers\AppController::class, 'social'])->name('social_view')->middleware('auth');
Route::post('/dashboard/apps/{id}/updated', [\App\Http\Controllers\AppController::class, 'socialUpdate'])->name('social_update')->middleware('auth');
Route::get('/dashboard/editor/', [\App\Http\Controllers\HomepageEditorController::class, 'index'])->name('editor.index')->middleware('auth');


Route::get('/dashboard/category', [\App\Http\Controllers\CategoryController::class, 'index'])->name('category')->middleware('auth');
Route::post('/dashboard/category/search', [\App\Http\Controllers\CategoryController::class, 'searchCategory'])->name('category.search')->middleware('auth');
Route::post('/dashboard/category/create', [\App\Http\Controllers\CategoryController::class, 'createCategory'])->name('category.create')->middleware('auth');
Route::get('/dashboard/category/{id}', [\App\Http\Controllers\CategoryController::class, 'category'])->name('category.edit')->middleware('auth');
Route::post('/dashboard/category/save/{id}', [\App\Http\Controllers\CategoryController::class, 'categorySave'])->name('category.save')->middleware('auth');
Route::post('/dashboard/category/delete/{id}', [\App\Http\Controllers\CategoryController::class, 'deleteCategory'])->name('category.delete')->middleware('auth');

Route::get('/dashboard/category/ajax/{id}', [\App\Http\Controllers\CategoryController::class, 'ajaxCategory'])->name('category.ajax')->middleware('auth');
Route::post('/dashboard/category/deleteRelation', [\App\Http\Controllers\CategoryController::class, 'deleteCategoryRelations'])->name('deleteRelation')->middleware('auth');
Route::post('/dashboard/category/addCategoryRelation', [\App\Http\Controllers\CategoryController::class, 'addCategoryRelations'])->name('addRelation')->middleware('auth');
Route::post('/dashboard/category/newOrder', [\App\Http\Controllers\CategoryController::class, 'categoryOrder'])->name('category.order')->middleware('auth');

Route::get('/dashboard/product', [\App\Http\Controllers\ProductController::class, 'index'])->name('product.index')->middleware('auth');
Route::post('/dashboard/product/create', [\App\Http\Controllers\ProductController::class, 'create'])->name('product.create')->middleware('auth');
Route::get('/dashboard/product/edit/{id}', [\App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit')->middleware('auth');
Route::post('/dashboard/product/edit/{id}/save', [\App\Http\Controllers\ProductController::class, 'save'])->name('product.save')->middleware('auth');
Route::post('/dashboard/product/delete/{id}', [\App\Http\Controllers\ProductController::class, 'delete'])->name('product.delete')->middleware('auth');
Route::post('/dashboard/product/search', [\App\Http\Controllers\ProductController::class, 'searchProduct'])->name('product.search')->middleware('auth');

Route::get('/dashboard/product/ajax/{id}', [\App\Http\Controllers\ProductController::class, 'fetchTable'])->name('product.fetchTable')->middleware('auth');
Route::post('/dashboard/product/addProductRelations', [\App\Http\Controllers\ProductController::class,'addPR'])->name('product.rA')->middleware('auth');
Route::post('/dashboard/product/deleteProductRelations', [\App\Http\Controllers\ProductController::class ,'dPR'])->name('product.dA')->middleware('auth');

Route::get('/dashboard/site/home', [\App\Http\Controllers\SiteController::class, 'home'])->name('site.home')->middleware('auth');
Route::post('dashboard/site/home/{id}', [\App\Http\Controllers\SiteController::class, 'homeEdit'])->name('site.homeedit')->middleware('auth');

Route::get('/dashboard/site/about', [\App\Http\Controllers\SiteController::class, 'aboutUs'])->name('site.about')->middleware('auth');
Route::post('/dashboard/site/about/{id}', [\App\Http\Controllers\SiteController::class, 'aboutUsEdit'])->name('site.aboutedit')->middleware('auth');

Route::get('/dashboard/overcategory',[OverCategoryController::class, 'index'])->name('overcategory')->middleware('auth');
Route::post('/dashboard/overcategory/getData',[OverCategoryController::class, 'getData'])->name('overcategoryData')->middleware('auth');
Route::post('/dashboard/overcategory/createData',[OverCategoryController::class, 'createData'])->name('overcategoryCreateData')->middleware('auth');
Route::post('/dashboard/overcategory/createNew',[OverCategoryController::class, 'create'])->name('overcategoryNew')->middleware('auth');
Route::post('/dashboard/overcategory/updateData', [OverCategoryController::class, 'updateData'])->name('overcategoryUpdateData')->middleware('auth');
Route::post('/dashboard/overcategory/deleteData', [OverCategoryController::class, 'deleteData'])->name('overcategoryDeleteData')->middleware('auth');
