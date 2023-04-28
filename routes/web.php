<?php

use App\Http\Controllers\CallbackController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Dashboard\AboutController;
use App\Http\Controllers\Dashboard\ArticleController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ChangePasswordController;
use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LicenseController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\Products\ArchiveProductController;
use App\Http\Controllers\Dashboard\Products\DestroyProductController;
use App\Http\Controllers\Dashboard\Products\PreorderProductController;
use App\Http\Controllers\Dashboard\Products\ProductController;
use App\Http\Controllers\Dashboard\Products\ProductQuestionController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\ResellerController;
use App\Http\Controllers\Dashboard\SiteSettingController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\Home\HomeArticleController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\HomeProductController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\User\MyAccountController;
use App\Http\Controllers\User\MyFavoriteController;
use App\Http\Controllers\User\MyHistoryController;
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
Route::get('preorder', function () {
    $data = [
        'name' => "Yudas Malabi",
        'email' => "yudasmalabi@gmail.com",
        'invoice_id' => "invoice-5e5cd271-3a8d-3ca6-9fe8-27d101b467f5",
        'pack_name' => "Windows 10 Professional test",
        'pack_price' => 16000,
        'quantity' => 1,
        'total_amount' => 17600,
        'payment_channel' => "OVO",
        'payment_method' => "E-Wallet",
        'paid_at' => "2021-12-26 07:10:07",
        'product_status' => "preorder",
        'product_type' => "serial",
        'attachment_file' => "product_attachments/kalender.pdf",
        'licenses' => [
            'username' => "yudas1337",
            'password' => "massiihgh",
            'serial_key' => "NMMKJ-6RK4F-KMJVX-8D9MJ-6MWKP"
        ]
    ];
    return view('emails.NotifyPreorderMail', compact('data'));

});
Route::get('preview', function () {
    $data = [
        'name' => "Yudas Malabi",
        'email' => "yudasmalabi@gmail.com",
        'invoice_id' => "invoice-5e5cd271-3a8d-3ca6-9fe8-27d101b467f5",
        'pack_name' => "Windows 10 Professional test",
        'pack_price' => 16000,
        'quantity' => 1,
        'total_amount' => 17600,
        'payment_channel' => "OVO",
        'payment_method' => "E-Wallet",
        'paid_at' => "2021-12-26 07:10:07",
        'product_status' => "preorder",
        'product_type' => "serial",
        'attachment_file' => "product_attachments/kalender.pdf",
        'licenses' => [
            'username' => "yudas1337",
            'password' => "massiihgh",
            'serial_key' => "NMMKJ-6RK4F-KMJVX-8D9MJ-6MWKP"
        ]
    ];

    return view('emails.invoicePaidMail', compact('data'));
});

Route::fallback(function () {
    return view('errors.404');
});

Auth::routes([
    'verify' => true
]);

Route::name('home.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('about-us', [AboutController::class, 'homepage'])->name('about');
    Route::get('frequently-asked-question', [HelpController::class, 'homepage'])->name('faq');
    Route::name('contact.')->prefix('contact-us')->group(function () {
        Route::get('contact-us', [ContactController::class, 'homepage'])->name('index');
        Route::post('contact-us', [ContactController::class, 'store'])->name('store');
    });
    Route::get('term-and-condition', [TermController::class, 'homepage'])->name('term');
    Route::get('privacy-policy', [PrivacyController::class, 'index'])->name('privacy');
    Route::resources([
        'products' => HomeProductController::class,
        'articles' => HomeArticleController::class
    ]);

    Route::prefix('checkout')->group(function () {
        Route::get('{invoice_id}/success', [CallbackController::class, 'showSuccessPage']);
        Route::get('{invoice_id}/failed', [CallbackController::class, 'showFailedPage']);
    });

});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::middleware('role:reseller|customer')->group(function () {
        Route::name('users.account.')->prefix('my-account')->group(function () {
            Route::get('/', [MyAccountController::class, 'index'])->name('index');
            Route::get('favorites', [MyFavoriteController::class, 'index'])->name('my-favorites');
            Route::resource('histories', MyHistoryController::class)->only('index', 'show');
        });
        Route::prefix('checkout')->group(function () {
            Route::get('{slug}', [TransactionController::class, 'index'])->name('checkout');
            Route::post('{slug}', [TransactionController::class, 'store'])->name('doCheckout');
        });
    });

    Route::middleware('role:admin')->group(function () {
        Route::prefix('dashboard')->group(function () {

            Route::name('dashboard.')->group(function () {
                Route::get('/', [DashboardController::class, 'index'])->name('index');
            });

            Route::resource('categories', CategoryController::class)->except('show');

            Route::resources([
                'products' => ProductController::class,
                'archive-products' => ArchiveProductController::class,
                'product-questions' => ProductQuestionController::class
            ]);

            Route::resource('preorder-products', PreorderProductController::class)->only('index');

            Route::post('licenses-update', [LicenseController::class, 'licensesUpdate'])->name('licenses.update');
            Route::resource('licenses', LicenseController::class)->only('show', 'store', 'destroy');

            Route::name('product.')->prefix('product')->group(function () {
                Route::get('count-stock/{product}', [ProductController::class, 'getStockDetail'])->name('count.stocks');
                Route::delete('destroy/{product}', [DestroyProductController::class, 'destroy'])->name('destroy');
                Route::delete('soft-delete/{product}', [DestroyProductController::class, 'softDestroy'])->name('soft.delete');
            });

            // order
            Route::name('orders.')->prefix('orders')->group(function () {
                Route::get('/', [OrderController::class, 'index'])->name('index');
                Route::get('{slug}', [OrderController::class, 'show'])->name('detail');
                Route::get('history', [OrderController::class, 'history'])->name('history');
            });

            // articles
            Route::resource('articles', ArticleController::class)->except('show');

            // users
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

            Route::prefix('configuration')->group(function () {
                Route::resource('faqs', HelpController::class);
                Route::name('contact-us.')->prefix('contact-us')->group(function () {
                    Route::get('/', [ContactController::class, 'index'])->name('index');
                    Route::delete('/', [ContactController::class, 'forceDelete'])->name('forceDelete');
                });
                Route::resources([
                    'site-setting' => SiteSettingController::class,
                    'terms' => TermController::class,
                    'about-us' => AboutController::class
                ], ['only' => ['index', 'update']]);

            });

        });

    });
});
