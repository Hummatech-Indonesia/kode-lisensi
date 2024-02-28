<?php

use App\Http\Controllers\CallbackController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Dashboard\AboutController;
use App\Http\Controllers\Dashboard\ArticleCategoryController;
use App\Http\Controllers\Dashboard\ArticleController;
use App\Http\Controllers\Dashboard\BannerController;
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
use App\Http\Controllers\Dashboard\ProductTestimonialController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\ResellerController;
use App\Http\Controllers\Dashboard\RevenueController;
use App\Http\Controllers\Dashboard\SiteSettingController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\Home\HomeArticleController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\HomeProductController;
use App\Http\Controllers\Home\ProductFavoriteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\User\MyAccountController;
use App\Http\Controllers\User\MyFavoriteController;
use App\Http\Controllers\User\MyHistoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VarianProductController;
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

Auth::routes([
    'verify' => true
]);

Route::name('home.')->group(function () {
    Route::get('send-email', function () {
        return view('emails.SendLicenseMail');
    });
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('latest-product', [HomeController::class, 'latestProduct']);

    Route::post('share-product-reseller/{product}/{code}', [HomeProductController::class, 'shareProductReseller'])->name('share.product.reseller');

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
    ], ['only' => ['index', 'show']]);

    Route::prefix('checkout')->group(function () {
        Route::get('{invoice_id}/success', [CallbackController::class, 'showSuccessPage']);
        Route::get('{invoice_id}/failed', [CallbackController::class, 'showFailedPage']);
    });
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::name('user.')->group(function () {
        Route::resources([
            'profile' => ProfileController::class,
            'change-password' => ChangePasswordController::class
        ], ['only' => ['index', 'update']]);

        Route::post('add-update-rating/{product_id}', [ProductTestimonialController::class, 'addOrUpdateRating'])->name('addOrUpdateRating');
    });

    Route::name('notification.')->prefix('notification')->group(function () {
        Route::post('mark-as-read/{take}', [NotificationController::class, 'index'])->name('markAsRead');
    });

    Route::middleware('role:reseller|customer')->group(function () {
        Route::name('users.account.')->prefix('my-account')->group(function () {
            Route::get('/', [MyAccountController::class, 'index'])->name('index');
            Route::get('favorites', [ProductFavoriteController::class, 'index'])->name('my-favorites');
            Route::resource('histories', MyHistoryController::class)->only('index', 'show');
        });
        Route::name('product.favorite.')->prefix('product-favorites')->group(function () {
            Route::get('{product}', [ProductFavoriteController::class, 'show'])->name('index');
            Route::post('{product}', [ProductFavoriteController::class, 'store'])->name('create');
            Route::delete('{product}', [ProductFavoriteController::class, 'delete'])->name('delete');
        });

        Route::prefix('checkout')->group(function () {
            Route::get('{slug}', [TransactionController::class, 'index'])->name('checkout');
            Route::post('{slug}', [TransactionController::class, 'store'])->name('doCheckout');
        });
    });
    Route::middleware('role:admin|author')->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::name('dashboard.')->group(function () {
                Route::get('/', [DashboardController::class, 'index'])->name('index');
            });
            // article
            Route::resources([
                'article-categories' => ArticleCategoryController::class,
                'articles' => ArticleController::class
            ], ['except' => ['show']]);
        });
    });

    Route::middleware('role:admin')->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::get('modify-ratings/{product_testimonial}', [ProductTestimonialController::class, 'modifyRating'])->name('modify.rating');


            Route::resource('categories', CategoryController::class)->except('show');

            Route::resources([
                'products' => ProductController::class,
                'archive-products' => ArchiveProductController::class,
                'product-questions' => ProductQuestionController::class
            ]);
            Route::patch('varian-products-update/{product}',[ProductController::class,'varianProductUpdate'])->name('varian.products.update');
            Route::post('varian-products', [ProductController::class, 'varianProductStore'])->name('varian.products.store');

            Route::resource('preorder-products', PreorderProductController::class)->only('index');

            Route::post('licenses-update', [LicenseController::class, 'licensesUpdate'])->name('licenses.update');
            Route::resource('licenses', LicenseController::class)->only('show', 'store', 'destroy');

            Route::name('product.')->prefix('product')->group(function () {
                Route::get('count-stock/{product}', [ProductController::class, 'getStockDetail'])->name('count.stocks');
                Route::delete('destroy/{product}', [DestroyProductController::class, 'destroy'])->name('destroy');
                Route::delete('soft-delete/{product}', [DestroyProductController::class, 'softDestroy'])->name('soft.delete');
            });

            Route::name('revenues.')->prefix('revenues')->group(function () {
                Route::get('totalAmount', [RevenueController::class, 'totalAmount'])->name('totalAmount');
                Route::get('/', [RevenueController::class, 'index'])->name('index');
                Route::get('print', [RevenueController::class, 'printRevenue'])->name('print');
            });

            // order
            Route::name('orders.')->group(function () {
                Route::prefix('orders')->group(function () {
                    Route::get('/', [OrderController::class, 'index'])->name('index');
                    Route::get('/get-all-histories', [OrderController::class, 'fetchHistories'])->name('fetch-histories');
                    Route::get('{invoice_id}', [OrderController::class, 'show'])->name('detail');
                    Route::post('{invoice_id}', [OrderController::class, 'update'])->name('update');
                });
                Route::get('order-histories', [OrderController::class, 'history'])->name('history');
            });


            Route::name('users.')->prefix('users')->group(function () {
                Route::get('/', [UserController::class, 'create'])->name('create');
                Route::post('/', [UserController::class, 'store'])->name('store');
                Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
                Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
                Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('delete');
                Route::name('customer.')->prefix('customer')->group(function () {
                    Route::get('/', [CustomerController::class, 'index'])->name('index');
                });
                Route::name('reseller.')->prefix('reseller')->group(function () {
                    Route::get('/', [ResellerController::class, 'index'])->name('index');
                });
                Route::name('admin.')->prefix('admin')->group(function () {
                    Route::get('/', [UserController::class, 'admin'])->name('index');
                });
                Route::name('author.')->prefix('author')->group(function () {
                    Route::get('/', [UserController::class, 'author'])->name('index');
                });
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
                    'about-us' => AboutController::class,
                    'slider' => SliderController::class,
                    'banners' => BannerController::class
                ], ['only' => ['index', 'update']]);
            });
        });
    });
});

Route::fallback(function () {
    return view('errors.404');
});
