<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SinhvienController;
use App\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;

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


Route::get('register',[AuthController::class, 'showFormRegister'])->name('show-form-register');
Route::post('register',[AuthController::class, 'register'])->name('register');


Route::get('login',[AuthController::class, 'showFormLogin'])->name('show-form-login');
Route::post('login',[AuthController::class, 'login'])->name('login');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('profile',[AuthController::class, 'showProfile'])->name('show-profile');
Route::post('profile',[AuthController::class, 'profile'])->name('profile');


Route::get('/',[UploadFileController::class, 'createForm'])->name('show-form-uploadFile');
Route::post('/',[UploadFileController::class, 'fileUpload'])->name('fileUpload');
Route::get('storagefile',[UploadFileController::class,'allfile'])->name('storagefile');

Route::get('storagefile/{id}/edit',[UploadFileController::class,'show_edit'])->name('show_edit');
Route::post('storagefile/{id}/edit',[UploadFileController::class,'edit'])->name('edit');
Route::put('editFile',[UploadFileController::class,'doedit'])->name('doedit');

Route::post('storagefile/download',[UploadFileController::class,'download'])->name('download');
Route::get('storagefile/download',[UploadFileController::class,'ondownload'])->name('ondownload');

Route::get('storagefile/delete',[UploadFileController::class,'ondelete'])->name('delete');
Route::delete('storagefile/deleteall/{id}',[UploadFileController::class,'deleteall'])->name('deleteall');

Route::get('find',[UploadFileController::class, 'find'])->name('find');
Route::get('{hash}',[UploadFileController::class,'show_edit_anonymous'])->name('anonymous');
