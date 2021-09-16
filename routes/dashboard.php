<?php

use App\Http\Controllers\Dashboard\Agency\AgencyController;
use App\Http\Controllers\Dashboard\Articles\ArticlesController;
use App\Http\Controllers\Dashboard\CategoryController\CategoryController;
use App\Http\Controllers\Dashboard\ContractDocument\ContractDocumentController;
use App\Http\Controllers\Dashboard\Customers\CustomersController;
use App\Http\Controllers\Dashboard\Gallery\GalleryController;
use App\Http\Controllers\Dashboard\Jobs\JobsController;
use App\Http\Controllers\Dashboard\Payments\PaymentsController;
use App\Http\Controllers\Dashboard\Service\ServicesController;
use App\Http\Controllers\Dashboard\ContactUs\ContactUsController;
use App\Http\Controllers\Dashboard\Home\HomeController;
use App\Http\Controllers\Dashboard\Orders\OrdersController;
use App\Http\Controllers\Dashboard\Product\ProductController;
use App\Http\Controllers\Dashboard\Role\RoleController;
use App\Http\Controllers\Dashboard\Settings\SettingsContoller;
use App\Http\Controllers\Dashboard\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Dashboard routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




/***************************************************  Routes For Dashboard  ***************************************************/

Route::get('/' , [HomeController::class , 'index'])->name('index');

/***************************************************  Routes For Roles  ***************************************************/

Route::resource('roles' , RoleController::class);

/***************************************************  Routes For Users  ***************************************************/

Route::resource('users' , UserController::class);
Route::get('users-table' , [UserController::class , 'usersTable'])->name('users-table');
Route::get('profile' , [UserController::class , 'profile'])->name('users.profile');
Route::put('profile' , [UserController::class , 'updateProfile'])->name('users.profile.update');

/***************************************************  Routes For Services  ***************************************************/

Route::resource('services' , ServicesController::class);
Route::get('services-table' , [ServicesController::class , 'servicesTable'])->name('services-table');
Route::get('information-technology-requests' , [ServicesController::class , 'informationTechnology'])->name('service.it');
Route::get('information-technology/{informationTechnologyService}' , [ServicesController::class , 'informationTechnologyShow'])->name('service.it.show');
Route::delete('information-technology/{informationTechnologyService}' , [ServicesController::class , 'informationTechnologyDestroy'])->name('service.it.destroy');
Route::get('information-technology-requests-table' , [ServicesController::class , 'informationTechnologyTable'])->name('service.it-table');
Route::get('environment-requests' , [ServicesController::class , 'environment'])->name('service.environment');
Route::get('environment/{environmentService}' , [ServicesController::class , 'environmentShow'])->name('service.env.show');
Route::delete('environment/{environmentService}' , [ServicesController::class , 'environmentDestroy'])->name('service.env.destroy');
Route::get('environment-requests-table' , [ServicesController::class , 'environmentTable'])->name('service.env-table');


/***************************************************  Routes For Products  ***************************************************/

Route::resource('products' , ProductController::class);
Route::get('products-table' , [ProductController::class , 'productsTable'])->name('products-table');
Route::post('products-ajax-buttons' , [ProductController::class , 'ajaxButtons'])->name('ajax-buttons');

/***************************************************  Routes For ContractDocuments  ***************************************************/

Route::resource('contract-documents' , ContractDocumentController::class);
Route::get('contract-documents-table' , [ContractDocumentController::class , 'contractDocumentsTable'])->name('contract-document-table');

/***************************************************  Routes For ContactUs  ***************************************************/

Route::resource('contactus' , ContactUsController::class)->only(['index' , 'show' , 'destroy']);
Route::get('contactus-table' , [ContactUsController::class , 'contactUsTable'])->name('contactus-table');

/***************************************************  Routes For Orders  ***************************************************/

Route::resource('orders' , OrdersController::class);
Route::get('orders-table' , [OrdersController::class , 'ordersTable'])->name('orders-table');

/***************************************************  Routes For Payments  ***************************************************/

Route::resource('payments' , PaymentsController::class);
Route::get('payments-table/{id}' , [PaymentsController::class , 'paymentsTable'])->name('payments-table');

/***************************************************  Routes For SiteSettings  ***************************************************/

Route::resource('settings' , SettingsContoller::class)->only(['index' , 'update']);


/***************************************************  Routes For Agency  ***************************************************/

Route::resource('category' , CategoryController::class);
Route::get('category-table' , [CategoryController::class , 'categoryTable'])->name('category-table');

/***************************************************  Routes For Agency  ***************************************************/

Route::resource('agencies' , AgencyController::class);
Route::get('agencies-table' , [AgencyController::class , 'agenciesTable'])->name('agencies-table');

/***************************************************  Routes For Articles  ***************************************************/

Route::resource('articles' , ArticlesController::class);
Route::get('articles-table' , [ArticlesController::class , 'articlesTable'])->name('articles-table');

/***************************************************  Routes For Customers  ***************************************************/

Route::resource('customers' , CustomersController::class);
Route::get('customers-table' , [CustomersController::class , 'customersTable'])->name('customers-table');

/***************************************************  Routes For Gallery  ***************************************************/

Route::resource('gallery' , GalleryController::class);
Route::get('gallery-table' , [GalleryController::class , 'galleryTable'])->name('gallery-table');

/***************************************************  Routes For Jobs  ***************************************************/

Route::resource('jobs' , JobsController::class);
Route::get('jobs-table' , [JobsController::class , 'jobsTable'])->name('jobs-table');
Route::get('applicants-table/{id}' , [JobsController::class , 'applicantsTable'])->name('applicants-table');
Route::get('applicants/{applicant}' , [JobsController::class , 'showApplicant'])->name('applicants.show');
Route::get('applicants-cv/{applicant}' , [JobsController::class , 'showCV'])->name('applicants.cv');
Route::delete('applicants/{applicant}' , [JobsController::class , 'deleteApplicant'])->name('applicants.destroy');
