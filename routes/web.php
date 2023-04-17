<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ChangePasswordController;
use App\Http\Controllers\Dashboard\ConfigurationController;
use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LicenseController;
use App\Http\Controllers\Dashboard\Products\ArchiveProductController;
use App\Http\Controllers\Dashboard\Products\DestroyProductController;
use App\Http\Controllers\Dashboard\Products\PreorderProductController;
use App\Http\Controllers\Dashboard\Products\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\ResellerController;
use App\Http\Controllers\Dashboard\SiteSettingController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\TermController;
use Illuminate\Support\Facades\Auth;
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

Route::fallback(function () {
    return view('errors.404');
});

Auth::routes([
    'verify' => true
]);

Route::name('home.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('about', [AboutController::class, 'index'])->name('about');
    Route::get('frequently-asked-question', [HelpController::class, 'homepage'])->name('faq');
    Route::get('contact', [ContactController::class, 'index'])->name('contact');
    Route::get('term-and-condition', [TermController::class, 'index'])->name('term');
    Route::get('privacy-policy', [PrivacyController::class, 'index'])->name('privacy');
    Route::resources([
        'products' => ProductController::class,
        'articles' => ArticleController::class
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::name('dashboard.')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('index');
        });

        Route::prefix('configuration')->group(function () {

            Route::resource('faqs', HelpController::class);

            Route::resources([
                'site-setting' => SiteSettingController::class,
                'terms' => TermController::class
            ], ['only' => ['index', 'update']]);

        });

        Route::resource('categories', CategoryController::class)->except('show');

        Route::name('user.')->group(function () {
            Route::resources([
                'profile' => ProfileController::class,
                'change-password' => ChangePasswordController::class
            ], ['only' => ['index', 'update']]);
        });

        Route::name('customer.')->prefix('customer')->group(function () {
            Route::get('/', [CustomerController::class, 'index'])->name('index');
        });

        Route::name('reseller.')->prefix('reseller')->group(function () {
            Route::get('/', [ResellerController::class, 'index'])->name('index');
        });

        Route::resources([
            'products' => ProductController::class,
            'archive-products' => ArchiveProductController::class
        ]);

        Route::resource('preorder-products', PreorderProductController::class)->only('index');

        Route::resource('licenses', LicenseController::class)->except('create');

        Route::name('product.')->prefix('product')->group(function () {
            Route::delete('destroy/{product}', [DestroyProductController::class, 'destroy'])->name('destroy');
            Route::delete('soft-delete/{product}', [DestroyProductController::class, 'softDestroy'])->name('soft.delete');
        });

    });

});
