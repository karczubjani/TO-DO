<?php

use App\Http\Controllers\TodoController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\OnlyGuests;

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
    return view('welcome') ;
});

Auth::routes();

Route::get('todos/index', function(){
    $users = User::paginate(15);
    return view('todos/index')->with('users', $users);
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('todos/index', [TodoController::class, 'index'])->name('todos.index')->middleware([OnlyGuests::class]);

Route::get('todos/create', [TodoController::class, 'create'])->name('todos.create')->middleware([OnlyGuests::class]);

Route::post('todos/store', [TodoController::class, 'store'])->name('todos.store')->middleware([OnlyGuests::class]);

Route::get('todos/show/{id}', [TodoController::class, 'show'])->name('todos.show')->middleware([OnlyGuests::class]);

Route::get('todos/{id}/edit', [TodoController::class, 'edit'])->name('todos.edit')->middleware([OnlyGuests::class]);

Route::put('todos/update', [TodoController::class, 'update'])->name('todos.update')->middleware([OnlyGuests::class]);

Route::delete('todos/destroy', [TodoController::class, 'destroy'])->name('todos.destroy')->middleware([OnlyGuests::class]);
