<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{BannerController,EntidadesFormadoreasController,OperadoresController, CategoryController,AsistentController, FaqController, FrontController, GeneralController, LinkController, HorarioController, PartnerController, PcategoryController, CursosController, PostController, FormadoresController, TagController, TestimonialController, TeamController, UserController};

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
Route::get('/', [FrontController::class, 'home'])->name('homepage');
Route::post('/', [FrontController::class, 'subscribe'])->name('subscribe');
Route::get('about-us', [FrontController::class, 'about'])->name('about');
Route::get('testimonials', [FrontController::class, 'testi'])->name('testi');
Route::get('services', [FrontController::class, 'service'])->name('service');
Route::get('services/{slug}', [FrontController::class, 'serviceshow'])->name('serviceshow');
Route::get('portfolio', [FrontController::class, 'portfolio'])->name('portfolio');
Route::get('portfolio/{slug}', [FrontController::class, 'portfolioshow'])->name('portfolioshow');
Route::get('blog', [FrontController::class, 'blog'])->name('blog');
Route::get('blog/search',[FrontController::class, 'search'])->name('search');
Route::get('blog/{slug}', [FrontController::class, 'blogshow'])->name('blogshow');
Route::get('categories/{category:slug}',[FrontController::class, 'category'])->name('category');
Route::get('tags/{tag:slug}',[FrontController::class, 'tag'])->name('tag');
Route::get('pages/{slug}', [FrontController::class, 'page'])->name('page');
Route::resource('entidades_formadoreas', 'Entidades_FormadoreasController');
Route::resource('formadores', \App\Http\Controllers\FormadoresController::class);



Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('dashboard', [GeneralController::class, 'dashboard'])->name('admin.dashboard');

    // General settings
    Route::get('general-settings', [GeneralController::class, 'general'])->middleware('can:isAdmin')->name('admin.general');
    Route::post('general-settings', [GeneralController::class, 'generalUpdate'])->middleware('can:isAdmin')->name('admin.general.update');

    // About
    Route::get('about', [GeneralController::class, 'about'])->middleware('can:isAdmin')->name('admin.about');
    Route::post('about', [GeneralController::class, 'aboutUpdate'])->middleware('can:isAdmin')->name('about.update');

    // Manage Banner
    Route::get('banner', [BannerController::class, 'index'])->middleware('can:isAdmin')->name('admin.banner');
    Route::get('banner/create', [BannerController::class, 'create'])->middleware('can:isAdmin')->name('admin.banner.create');
    Route::post('banner/create', [BannerController::class, 'store'])->middleware('can:isAdmin')->name('admin.banner.store');
    Route::get('banner/edit/{id}', [BannerController::class, 'edit'])->middleware('can:isAdmin')->name('admin.banner.edit');
    Route::post('banner/edit/{id}', [BannerController::class, 'update'])->middleware('can:isAdmin')->name('admin.banner.update');
    Route::delete('banner/destroy/{id}',[BannerController::class, 'destroy'])->middleware('can:isAdmin')->name('admin.banner.destroy');

     // Manage Portfolio Categories
     Route::get('portfolio-categories', [PcategoryController::class, 'index'])->name('admin.pcategory');
     Route::post('portfolio-categories', [PcategoryController::class, 'store'])->name('admin.pcategory.store');
     Route::get('Portfolio-categories/edit/{id}', [PcategoryController::class, 'edit'])->name('admin.pcategory.edit');
     Route::post('Portfolio-categories/edit/{id}', [PcategoryController::class, 'update'])->name('admin.pcategory.update');
     Route::delete('Portfolio-categories/destroy/{id}',[PcategoryController::class, 'destroy'])->name('admin.pcategory.destroy');

     // Manage asistent
    Route::get('asistent', [AsistentController::class, 'index'])->name('admin.asistent');
    Route::get('asistent/create/{id}', [AsistentController::class, 'create'])->name('admin.asistent.create');
    Route::post('asistent/create', [AsistentController::class, 'store'])->name('admin.asistent.store');
    Route::get('asistent/edit/{id}', [AsistentController::class, 'edit'])->name('admin.asistent.edit');
    Route::post('asistent/edit/{id}', [AsistentController::class, 'update'])->name('admin.asistent.update');
    Route::delete('asistent/destroy/{id}',[AsistentController::class, 'destroy'])->name('admin.asistent.destroy');

    // Manage Portfolio
    Route::get('cursos', [CursosController::class, 'index'])->name('admin.cursos');
    Route::get('inactiveCursos', [CursosController::class, 'index2'])->name('admin.inactiveCursos');
    Route::get('cursos/create', [CursosController::class, 'create'])->name('admin.cursos.create');
    Route::post('cursos/create', [CursosController::class, 'store'])->name('admin.cursos.store');
    Route::get('cursos/edit/{id}', [CursosController::class, 'edit'])->name('admin.cursos.edit');
    Route::post('cursos/edit/{id}', [CursosController::class, 'update'])->name('admin.cursos.update');
    Route::delete('cursos/destroy/{id}',[CursosController::class, 'destroy'])->name('admin.cursos.destroy');
    Route::post('cursos/activo/{id}',[CursosController::class, 'activo'])->name('admin.cursos.activo');


    // Manage Categories
     Route::get('categories', [CategoryController::class, 'index'])->name('admin.category');
     Route::get('categories/create', [CategoryController::class, 'create'])->name('admin.category.create');
     Route::post('categories/create', [CategoryController::class, 'store'])->name('admin.category.store');
     Route::get('categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
     Route::post('categories/edit/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
     Route::delete('categories/destroy/{id}',[CategoryController::class, 'destroy'])->name('admin.category.destroy');

     // Manage Tags
     Route::get('tags', [TagController::class, 'index'])->name('admin.tag');
     Route::get('tags/create', [TagController::class, 'create'])->name('admin.tag.create');
     Route::post('tags/create', [TagController::class, 'store'])->name('admin.tag.store');
     Route::get('tags/edit/{id}', [TagController::class, 'edit'])->name('admin.tag.edit');
     Route::post('tags/edit/{id}', [TagController::class, 'update'])->name('admin.tag.update');
     Route::delete('tags/destroy/{id}',[TagController::class, 'destroy'])->name('admin.tag.destroy');

     // Manage Blog
    Route::get('post',[PostController::class, 'index'])->middleware('can:isAdmin')->name('admin.post');
    Route::get('post/create',[PostController::class, 'create'])->middleware('can:isAdmin')->name('admin.post.create');
    Route::post('post/create',[PostController::class, 'store'])->middleware('can:isAdmin')->name('admin.post.store');
    Route::get('post/edit/{id}',[PostController::class, 'edit'])->middleware('can:isAdmin')->name('admin.post.edit');
    Route::post('post/edit/{id}',[PostController::class, 'update'])->middleware('can:isAdmin')->name('admin.post.update');
    Route::get('post/trash',[PostController::class, 'trash'])->middleware('can:isAdmin')->name('admin.post.trash');
    Route::post('post/{id}/restore',[PostController::class, 'restore'])->middleware('can:isAdmin')->name('admin.post.restore');
    Route::delete('post/trash/{id}',[PostController::class, 'destroy'])->middleware('can:isAdmin')->name('admin.post.destroy');
    Route::delete('post/destroy/{id}',[PostController::class, 'deletePermanent'])->middleware('can:isAdmin')->name('admin.post.deletePermanent');

    // Manage Testimonials
    Route::get('testimonials', [TestimonialController::class, 'index'])->name('admin.testi');
    Route::get('testimonials/create', [TestimonialController::class, 'create'])->name('admin.testi.create');
    Route::post('testimonials/create', [TestimonialController::class, 'store'])->name('admin.testi.store');
    Route::get('testimonials/edit/{id}', [TestimonialController::class, 'edit'])->name('admin.testi.edit');
    Route::post('testimonials/edit/{id}', [TestimonialController::class, 'update'])->name('admin.testi.update');
    Route::delete('testimonials/destroy/{id}',[TestimonialController::class, 'destroy'])->name('admin.testi.destroy');

    // Manage Pages
    Route::get('horario', [HorarioController::class, 'index'])->name('admin.horario');
    Route::get('horario/create/{id}', [HorarioController::class, 'create'])->name('admin.horario.create');
    Route::post('horario/create', [HorarioController::class, 'store'])->name('admin.horario.store');
    Route::get('horario/edit/{id}', [HorarioController::class, 'edit'])->name('admin.horario.edit');
    Route::post('horario/edit/{id}', [HorarioController::class, 'update'])->name('admin.horario.update');
    Route::delete('horario/destroy/{id}',[HorarioController::class, 'destroy'])->name('admin.horario.destroy');

    // Manage Links
    Route::get('links', [LinkController::class, 'index'])->name('admin.link');
    Route::get('links/create', [LinkController::class, 'create'])->name('admin.link.create');
    Route::post('links/create', [LinkController::class, 'store'])->name('admin.link.store');
    Route::get('links/edit/{id}', [LinkController::class, 'edit'])->name('admin.link.edit');
    Route::post('links/edit/{id}', [LinkController::class, 'update'])->name('admin.link.update');
    Route::delete('links/destroy/{id}',[LinkController::class, 'destroy'])->name('admin.link.destroy');

    // Manage FAQ
    Route::get('faq', [FaqController::class, 'index'])->name('admin.faq');
    Route::get('faq/create', [FaqController::class, 'create'])->name('admin.faq.create');
    Route::post('faq/create', [FaqController::class, 'store'])->name('admin.faq.store');
    Route::get('faq/edit/{id}', [FaqController::class, 'edit'])->name('admin.faq.edit');
    Route::post('faq/edit/{id}', [FaqController::class, 'update'])->name('admin.faq.update');
    Route::delete('faq/destroy/{id}',[FaqController::class, 'destroy'])->name('admin.faq.destroy');

    // Manage Partners
    Route::get('partners', [PartnerController::class, 'index'])->middleware('can:isAdmin')->name('admin.partner');
    Route::get('partners/create', [PartnerController::class, 'create'])->middleware('can:isAdmin')->name('admin.partner.create');
    Route::post('partners/create', [PartnerController::class, 'store'])->middleware('can:isAdmin')->name('admin.partner.store');
    Route::get('partners/edit/{id}', [PartnerController::class, 'edit'])->middleware('can:isAdmin')->name('admin.partner.edit');
    Route::post('partners/edit/{id}', [PartnerController::class, 'update'])->middleware('can:isAdmin')->name('admin.partner.update');
    Route::delete('partners/destroy/{id}',[PartnerController::class, 'destroy'])->middleware('can:isAdmin')->name('admin.partner.destroy');

    // Manage Services
    Route::get('formadores', [FormadoresController::class, 'index'])->name('admin.formadores');
    Route::get('formadores/create', [FormadoresController::class, 'create'])->name('admin.formadores.create');
    Route::post('formadores/create', [FormadoresController::class, 'store'])->name('admin.formadores.store');
    Route::get('formadores/edit/{id}', [FormadoresController::class, 'edit'])->name('admin.formadores.edit');
    Route::post('formadores/edit/{id}', [FormadoresController::class, 'update'])->name('admin.formadores.update');
    Route::delete('formadores/destroy/{id}',[FormadoresController::class, 'destroy'])->name('admin.formadores.destroy');

    // Manage Services
    Route::get('operadores', [OperadoresController::class, 'index'])->name('admin.operadores');
    Route::get('operadores/create', [OperadoresController::class, 'create'])->name('admin.operadores.create');
    Route::post('operadores/create', [OperadoresController::class, 'store'])->name('admin.operadores.store');
    Route::get('operadores/edit/{id}', [OperadoresController::class, 'edit'])->name('admin.operadores.edit');
    Route::post('operadores/edit/{id}', [OperadoresController::class, 'update'])->name('admin.operadores.update');
    Route::delete('operadores/destroy/{id}',[OperadoresController::class, 'destroy'])->name('admin.operadores.destroy');

    // Manage Team
    Route::get('entidades_formadores', [EntidadesFormadoreasController::class, 'index'])->middleware('can:isAdminOrResponsable')->name('admin.entidades_formadoreas');
    Route::get('entidades_formadores/create', [EntidadesFormadoreasController::class, 'create'])->middleware('can:isAdminOrResponsable')->name('admin.entidades_formadoreas.create');
    Route::post('entidades_formadores/create', [EntidadesFormadoreasController::class, 'store'])->middleware('can:isAdminOrResponsable')->name('admin.entidades_formadoreas.store');
    Route::get('entidades_formadores/edit/{id}', [EntidadesFormadoreasController::class, 'edit'])->middleware('can:isAdminOrResponsable')->name('admin.entidades_formadoreas.edit');
    Route::post('entidades_formadores/edit/{id}', [EntidadesFormadoreasController::class, 'update'])->middleware('can:isAdminOrResponsable')->name('admin.entidades_formadoreas.update');
    Route::delete('entidades_formadores/destroy/{id}',[EntidadesFormadoreasController::class, 'destroy'])->middleware('can:isAdmin')->name('admin.entidades_formadoreas.destroy');

     // Manage Admin
     Route::get('users', [UserController::class, 'index'])->middleware('can:isAdminOrResponsable')->name('admin.user');
     Route::post('users/{id}', [UserController::class, 'changepassword'])->middleware('can:isAdminOrResponsable')->name('admin.user.changepassword');
     Route::get('users/create', [UserController::class, 'create'])->middleware('can:isAdminOrResponsable')->name('admin.user.create');
     Route::post('users/create', [UserController::class, 'store'])->middleware('can:isAdminOrResponsable')->name('admin.user.store');
     Route::get('users/edit/{id}', [UserController::class, 'edit'])->middleware('can:isAdminOrResponsable')->name('admin.user.edit');
     Route::post('users/edit/{id}', [UserController::class, 'update'])->middleware('can:isAdminOrResponsable')->name('admin.user.update');
     Route::delete('users/destroy/{id}',[UserController::class, 'destroy'])->middleware('can:isAdmin')->name('admin.user.destroy');
});
