<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MultimediaController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
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

////////////////////////////////////////////////////////////////////////////////// Front-office
Route::get('/', [HomeController::class, 'index']); //pagina de home front-office

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

//// Contact Controller
Route::get('/support', [ContactController::class, 'ContactForm'])->name('contact'); //pagina de support/mandar mensagens
Route::post('/save-message', [ContactController::class, 'saveContactMessage'])->name('contact.save'); // Criar entrada na coluna Contact com os inputs do form

// Passar todos os dados para o front movies MovieController
Route::get('/movies', [MovieController::class, 'index'])->name('movies.all'); // mostrar todos os filmes
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show'); // mostrar filme individualmente(details)
Route::post('/movies/addtofavorites', [MovieController::class, 'addToFavorites'])->name('add.to.favorites'); //adicionar aos favoritos na pagina dos filmes
Route::post('/movies/removefromfavorites', [MovieController::class, 'removefromFavorites'])->name('remove.from.favorites'); //remover dos favoritos na pagina dos filmes


//Favorites Controller
Route::middleware(['auth'])->group(function () {
    Route::get('/favorites', [FavoritesController::class, 'favorites'])->name('movies.favorites');
    Route::delete('/favorites/{multimediaFavoritosId}', [FavoritesController::class, 'remove'])->name('favorites.remove'); // eliminar media de uma lista
    Route::put('/favorites/update/{id}', [FavoritesController::class, 'update'])->name('favorites.update'); // update ao nome da lista
    Route::delete('/favorites/delete/{id}', [FavoritesController::class, 'destroy'])->name('favorites.destroy');// eliminar lista
    Route::post('/favorites/create', [FavoritesController::class, 'create'])->name('favorites.create'); //Criar nova lista
}); 
// Message se tentar aceder ao watchlist sem conta
Route::get('/no-account', [SessionsController::class, 'redirectToStartStream'])->name('no-account');


//Comments Controller
Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store'); //criar comentario pai ou flho depende do request que vem
Route::delete('/comments/delete/{id}', [CommentController::class, 'destroy'])->name('comments.destroy'); //eliminar comentario e comentarios filhos
Route::put('/comments/update/{id}', [CommentController::class, 'update'])->name('comments.update'); //editar comentario
// Message se tentar comentar sem conta
Route::get('/no-account-comment', [SessionsController::class, 'redirectToStart'])->name('no-account-comment');


//Multimedia Likes Controller
Route::middleware(['auth'])->group(function () {
    Route::post('/like/{multimedia}', [LikeController::class, 'like'])->name('like'); // dar like na multimedia
    Route::delete('/unlike/{multimedia}', [LikeController::class, 'unlike'])->name('unlike'); // unlike na multimedia
});
// Message se tentar dar like sem conta
Route::get('/no-account-like', [SessionsController::class, 'redirectStart'])->name('no-account-like');

//Comment Likes Controller
Route::middleware(['auth'])->group(function () {
    Route::post('/commentlike/{comment}', [CommentLikeController::class, 'commentlike'])->name('commentlike'); // dar like no comment
    Route::delete('/commentunlike/{comment}', [CommentLikeController::class, 'commentunlike'])->name('commentunlike'); // unlike no comment
});
// Message se tentar dar like sem conta
Route::get('/no-account-like', [SessionsController::class, 'redirectStart'])->name('no-account-like');

Route::middleware(['guest'])->group(function () {
    //Register
    Route::get('register', [RegisterController::class,'create']); //mostrar página
    Route::post('register', [RegisterController::class,'register']); // registar na base de dados

    //Login
    Route::get('login',[SessionsController::class,'create']); //mostrar página
    Route::post('login',[SessionsController::class,'login']); // verificar se existe e dar login
});

//Logout
Route::post('logout', [SessionsController::class,'logout'])->middleware('auth');



//////////////////////////////////////////////////////////////////////////////// Back-office
Route::get('admin', [AdminController::class,'home'])->middleware('admin'); //mostrar página admin do back-office, // a middleware que criamos e colocamos no kernell

//Multimedia controller
Route::middleware(['admin'])->group(function () {
    Route::get('admin/multimedia', [MultimediaController::class, 'index'])->name('admin.multimedia'); // mostrar tabela multimedia
    Route::delete('admin/multimedia/delete/{id}', [MultimediaController::class, 'delete'])->name('admin.multimedia.delete'); // eliminar dados
    Route::get('admin/multimedia/edit/{id}', [MultimediaController::class, 'edit'])->name('admin.multimedia.edit'); 
    Route::put('admin/multimedia/update/{id}', [MultimediaController::class, 'update'])->name('admin.multimedia.update');
    Route::get('admin/multimedia/create', [MultimediaController::class, 'create'])->name('admin.multimedia.create');
    Route::post('admin/multimedia/store', [MultimediaController::class, 'store'])->name('admin.multimedia.store');
});

//Type controller
Route::middleware(['admin'])->group(function () {
    Route::get('admin/types', [TypeController::class, 'index'])->name('admin.types'); // mostrar tabela types
    Route::delete('admin/types/delete/{id}', [TypeController::class, 'delete'])->name('admin.types.delete'); // eliminar dados
    Route::get('admin/types/edit/{id}', [TypeController::class, 'edit'])->name('admin.types.edit'); 
    Route::put('admin/types/update/{id}', [TypeController::class, 'update'])->name('admin.types.update');
    Route::get('admin/types/create', [TypeController::class, 'create'])->name('admin.types.create');
    Route::post('admin/types/store', [TypeController::class, 'store'])->name('admin.types.store');
});

//Genre controller
Route::middleware(['admin'])->group(function () {
    Route::get('admin/genres', [GenreController::class, 'index'])->name('admin.genres'); // mostrar tabela genres
    Route::delete('admin/genres/delete/{id}', [GenreController::class, 'delete'])->name('admin.genres.delete');
    Route::get('admin/genres/edit/{id}', [GenreController::class, 'edit'])->name('admin.genres.edit'); 
    Route::put('admin/genres/update/{id}', [GenreController::class, 'update'])->name('admin.genres.update');
    Route::get('admin/genres/create', [GenreController::class, 'create'])->name('admin.genres.create');
    Route::post('admin/genres/store', [GenreController::class, 'store'])->name('admin.genres.store');
});

//Person controller
Route::middleware(['admin'])->group(function () {
    Route::get('admin/persons', [PersonController::class, 'index'])->name('admin.persons'); // mostrar tabela persons
    Route::delete('admin/persons/delete/{id}', [PersonController::class, 'delete'])->name('admin.persons.delete');
    Route::get('admin/persons/edit/{id}', [PersonController::class, 'edit'])->name('admin.persons.edit'); 
    Route::put('admin/persons/update/{id}', [PersonController::class, 'update'])->name('admin.persons.update');
    Route::get('admin/persons/create', [PersonController::class, 'create'])->name('admin.persons.create');
    Route::post('admin/persons/store', [PersonController::class, 'store'])->name('admin.persons.store');
});

//User controller
Route::middleware(['admin'])->group(function () {
    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users'); // mostrar tabela users
    Route::delete('admin/users/delete/{id}', [UserController::class, 'delete'])->name('admin.users.delete');
    Route::get('admin/users/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit'); 
    Route::put('admin/users/update/{id}', [UserController::class, 'update'])->name('admin.users.update');
});

//Contacts controller
Route::middleware(['admin'])->group(function () {
    Route::get('admin/contacts', [ContactController::class, 'index'])->name('admin.contacts'); // mostrar tabela messages
    Route::post('/update-read', [ContactController::class, 'updateRead'])->name('update.read');
});