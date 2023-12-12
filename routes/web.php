<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\HeaderController;
use PHPUnit\TextUI\XmlConfiguration\Group;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\PageSettingsController;
use App\Http\Controllers\ContactSettingController;
use Illuminate\Support\Facades\Auth;

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


Auth::routes();

Route::middleware(['auth'])->group(function (){
    Route::view('/admin', 'admin.dashboard');
    Route::resource('admin/blogposts', BlogPostController::class);
    Route::middleware(['admin'])->group(function () {

    

Route::resource('/admin/pages', PageController::class);




Route::resource('/admin/menus', MenuController::class);

Route::prefix('/admin/menus/{menu}')->group(function () {
    Route::get('menuitems', [MenuItemController::class, 'index'])->name('menus.menuitems.index');
    Route::get('menuitems/create', [MenuItemController::class, 'create'])->name('menus.menuitems.create');
    Route::post('menuitems', [MenuItemController::class, 'store'])->name('menus.menuitems.store');
    Route::get('menuitems/{menuitem}', [MenuItemController::class, 'show'])->name('menus.menuitems.show');
    Route::get('menuitems/{menuitem}/edit', [MenuItemController::class, 'edit'])->name('menus.menuitems.edit');
    Route::put('menuitems/{menuitem}', [MenuItemController::class, 'update'])->name('menus.menuitems.update');
    Route::delete('menuitems/{menuitem}', [MenuItemController::class, 'destroy'])->name('menus.menuitems.destroy');
    Route::post('/reorder', [MenuItemController::class, 'reorder'])->name('menus.menuitems.reorder');
});




Route::get('/admin/users', [App\Http\Controllers\UsersController::class, 'index']);
Route::get('/admin/users/create', [App\Http\Controllers\UsersController::class, 'create']);
Route::post('/admin/users', [App\Http\Controllers\UsersController::class, 'store']);
Route::get('/admin/users/{id}', [App\Http\Controllers\UsersController::class, 'show']);
Route::get('/admin/users/{id}/edit', [App\Http\Controllers\UsersController::class, 'edit']);
Route::patch('/admin/users/{id}', [App\Http\Controllers\UsersController::class, 'update']);
Route::delete('/admin/users/{id}', [App\Http\Controllers\UsersController::class, 'destroy']);

Route::get('/admin/roles', [App\Http\Controllers\RolesController::class, 'index']);
Route::get('/admin/roles/create', [App\Http\Controllers\RolesController::class, 'create']);
Route::post('/admin/roles', [App\Http\Controllers\RolesController::class, 'store']);
Route::get('/admin/roles/{id}', [App\Http\Controllers\RolesController::class, 'show']);
Route::get('/admin/roles/{id}/edit', [App\Http\Controllers\RolesController::class, 'edit']);
Route::patch('/admin/roles/{id}', [App\Http\Controllers\RolesController::class, 'update']);
Route::delete('/admin/roles/{id}', [App\Http\Controllers\RolesController::class, 'destroy']);

Route::get('admin/header', [HeaderController::class, 'index'])->name('header.index');
Route::get('admin/header/edit', [HeaderController::class, 'edit'])->name('header.edit');
Route::post('admin/header/update', [HeaderController::class, 'update'])->name('header.update');

Route::get('admin/footer', [FooterController::class, 'index'])->name('footer.index');
Route::get('admin/footer/edit', [FooterController::class, 'edit'])->name('footer.edit');
Route::put('admin/footer/update', [FooterController::class, 'update'])->name('footer.update');

Route::get('/admin/messages', [App\Http\Controllers\MessageController::class, 'index']);
Route::get('/admin/messages/{id}', [App\Http\Controllers\MessageController::class, 'show']);
Route::delete('/admin/messages/{id}', [App\Http\Controllers\MessageController::class, 'destroy']);

Route::get('/admin/settings', [PageSettingsController::class, 'index'])->name('admin.page-settings.index');
Route::get('/admin/settings/create', [PageSettingsController::class, 'create'])->name('admin.page-settings.create');
Route::post('/admin/settings', [PageSettingsController::class, 'store'])->name('admin.page-settings.store');
Route::get('/admin/settings/{pageSetting}/edit', [PageSettingsController::class, 'edit'])->name('admin.page-settings.edit');
Route::put('/admin/settings/{pageSetting}', [PageSettingsController::class, 'update'])->name('admin.page-settings.update');
Route::delete('/admin/page-settings/{pageSetting}', [PageSettingsController::class, 'destroy'])
     ->name('admin.page-settings.destroy');


Route::resource('admin/contacts', ContactSettingController::class);
Route::get('admin/contacts/{slug}', [ContactSettingController::class, 'showContactForm'])->name('contact.form');



});
});

Route::post('/contacts/{slug}/submit', [ContactSettingController::class, 'submitContactForm'])->name('contact.submit');
Route::post('/comments', 'App\Http\Controllers\CommentController@store')->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::get('/blogposts/{id}', [App\Http\Controllers\BlogPostController::class, 'show'])->name('blogposts.show');






// Creating new pages
Route::get('/{slug}', [PageController::class, 'handleSlug'])->name('handle.slug');



Route::get('/', function () {
    return redirect('/home');
});



