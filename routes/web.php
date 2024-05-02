<?php

use App\Contracts\Interfaces\TransactionAffiliateInterface;
use App\Http\Controllers\Administrator\RefundController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AdminWithdrawalController;
use App\Http\Controllers\CallbackController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Dashboard\AboutController;
use App\Http\Controllers\Dashboard\ArticleCategoryController;
use App\Http\Controllers\Dashboard\ArticleController;
use App\Http\Controllers\Dashboard\BalanceWithdrawalController;
use App\Http\Controllers\Dashboard\BannerController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ChangePasswordController;
use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LicenseController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\PinRekeningController;
use App\Http\Controllers\Dashboard\Products\ArchiveProductController;
use App\Http\Controllers\Dashboard\Products\DestroyProductController;
use App\Http\Controllers\Dashboard\Products\ProductController;
use App\Http\Controllers\Dashboard\Products\ProductQuestionController;
use App\Http\Controllers\Dashboard\ProductTestimonialController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RekeningNumberController;
use App\Http\Controllers\Dashboard\ResellerController;
use App\Http\Controllers\Dashboard\ResellerDashboardController;
use App\Http\Controllers\Dashboard\RevenueController;
use App\Http\Controllers\Dashboard\SiteSettingController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\Dashboard\SubArticleCategoryController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\Home\HomeArticleController;
use App\Http\Controllers\Home\HomeCategoryController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\HomeProductController;
use App\Http\Controllers\Home\ProductFavoriteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ProductEmailController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\TransactionAffiliateController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionWhatsappController;
use App\Http\Controllers\UpdateIdInvoiceController;
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

Route::prefix('dashboard')->group(function () {
    Route::name('dashboard.')->group(function () {
        Route::get('profit', [ResellerDashboardController::class, 'profit'])->name('profit.transaction');
        Route::prefix('dashboard')->group(function () {
            Route::name('pin.rekening.')->group(function () {
                Route::get('pin-rekening/{pin}/{id}', [PinRekeningController::class, 'index'])->name('index');
            });
        });
    });
});


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

    Route::get('categories/{slug}', [HomeCategoryController::class, 'show'])->name('category');

    Route::get('term-and-condition', [TermController::class, 'homepage'])->name('term');
    Route::get('privacy-policy', [PrivacyController::class, 'index'])->name('privacy');
    Route::resources([
        'products' => HomeProductController::class,
        'articles' => HomeArticleController::class
    ], ['only' => ['index', 'show', 'showShare']]);

    Route::get('products/{slug}/{code_affiliate?}', [HomeProductController::class, 'show']);

    Route::get('share-product/{slug?}', [ProductController::class, 'shareButtons'])->name('share.product');

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
    Route::middleware('role:admin|author|reseller|administrator')->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::name('dashboard.')->group(function () {
                Route::get('/', [DashboardController::class, 'index'])->name('index');
            });
        });
    });


    Route::middleware('role:admin|reseller')->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::name('dashboard.')->group(function () {
                Route::get('history', function () {
                    return view('dashboard.pages.reseller-dashboard.history');
                })->name('history.transaction');
                Route::get('notification', [ResellerDashboardController::class, 'notification'])->name('notification');
            });
        });
    });

    Route::middleware('role:reseller')->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::name('dashboard.')->group(function () {
                Route::get('profit', [ResellerDashboardController::class, 'profit'])->name('profit.transaction');
                Route::prefix('balance-withdrawal')->group(function () {
                    Route::name('balance.withdrawal.')->group(function () {
                        Route::resource('rekening-numbers', RekeningNumberController::class)->except('index');
                        Route::get('rekening-numbers/{rekening_number}', [RekeningNumberController::class, 'index'])->name('rekening-numbers.index');
                        Route::get('/', [BalanceWithdrawalController::class, 'index'])->name('index');
                        Route::get('history', [BalanceWithdrawalController::class, 'history'])->name('history');
                        Route::post('balance-withdrawals/{rekening_number}', [BalanceWithdrawalController::class, 'store'])->name('store');
                    });
                    Route::name('pin.rekening.')->group(function () {
                        Route::post('pin-rekening', [PinRekeningController::class, 'sendEmail'])->name('send.email');
                    });
                });
            });
        });
    });

    Route::middleware('role:administrator|reseller|customer')->group(function () {
        Route::prefix('checkout')->group(function () {
            Route::get('{slug}/{slug_varian?}', [TransactionController::class, 'index'])->name('checkout');
        });
    });
    Route::middleware('role:administrator')->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::name('dashboard.')->group(function () {
                Route::resource('expenditure', ExpenditureController::class);
                Route::get('expenditure', [ExpenditureController::class, 'fetchExpenditure'])->name('fetch.expenditure');
                Route::name('refund.')->prefix('refund')->group(function () {
                    Route::get('/', [RefundController::class, 'index'])->name('index');
                    Route::post('approve/{refund}', [RefundController::class, 'approve'])->name('approve');
                    Route::put('reject/{refund}', [RefundController::class, 'reject'])->name('reject');
                });
            });
        });

        Route::prefix('transaction-whatsapp')->group(function () {
            ROute::name('transaction.whatsapp.')->group(function () {
                Route::post('{slug}/{slug_varian?}', [TransactionWhatsappController::class, 'store'])->name('checkout');
            });
        });
    });

    Route::middleware('role:reseller|customer')->group(function () {
        Route::name('users.account.')->prefix('my-account')->group(function () {
            Route::get('/', [MyAccountController::class, 'index'])->name('index');
            Route::get('favorites', [ProductFavoriteController::class, 'index'])->name('my-favorites');
            Route::resource('histories', MyHistoryController::class)->only('index', 'show');
        });
        Route::prefix('dashboard')->group(function () {
            Route::name('dashboard.')->group(function () {
                Route::name('refund.')->prefix('refund')->group(function () {
                    Route::post('{transaction}', [RefundController::class, 'store'])->name('store');
                });
            });
        });
        Route::name('product.favorite.')->prefix('product-favorites')->group(function () {
            Route::get('{product}', [ProductFavoriteController::class, 'show'])->name('index');
            Route::post('{product}', [ProductFavoriteController::class, 'store'])->name('create');
            Route::delete('{product}', [ProductFavoriteController::class, 'delete'])->name('delete');
        });

        Route::prefix('checkout')->group(function () {
            Route::post('{slug}/{slug_varian?}', [TransactionController::class, 'store'])->name('doCheckout');
        });
        Route::prefix('checkout-products')->group(function () {
            Route::get('{slug}/{code_affiliate}/{slug_varian?}', [TransactionAffiliateController::class, 'index'])->name('checkout.products');
            Route::post('{slug}/{code_affiliate}/{slug_varian?}', [TransactionAffiliateController::class, 'store'])->name('doCheckout.products');
        });
    });

    Route::middleware('role:admin|author')->group(function () {
        Route::prefix('dashboard')->group(function () {
            // article
            Route::resources([
                'articles' => ArticleController::class
            ], ['except' => ['show']]);
            Route::resources([
                'article-categories' => ArticleCategoryController::class,
            ]);
            Route::resource('sub-article-categories', SubArticleCategoryController::class)->except(['create', 'store', 'show', 'update', 'edit']);
            Route::get('sub-article-categories/{article_category}', [SubArticleCategoryController::class, 'create'])->name('sub-article-categories.create');
            Route::post('sub-article-categories/{article_category}', [SubArticleCategoryController::class, 'store'])->name('sub-article-categories.store');
            Route::get('sub-article-categories/{article_category}/{sub_article_category}', [SubArticleCategoryController::class, 'edit'])->name('sub-article-categories.edit');
            Route::patch('sub-article-categories/{article_category}/{sub_article_category}', [SubArticleCategoryController::class, 'update'])->name('sub-article-categories.update');
        });
    });

    Route::middleware('role:admin|administrator')->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::put('post-product-recommendation/{product}', [ProductController::class, 'updateStatus'])->name('product.recommendation.update');
            Route::put('delete-product-recommendation/{product}', [ProductController::class, 'deleteStatus'])->name('product.recommendation.delete');

            Route::get('modify-ratings/{product_testimonial}', [ProductTestimonialController::class, 'modifyRating'])->name('modify.rating');

            Route::resource('categories', CategoryController::class)->except('show');
            Route::get('categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
            Route::get('categories-ajax', [CategoryController::class, 'getAjax'])->name('categories.ajax');

            Route::resources([
                'products' => ProductController::class,
                'archive-products' => ArchiveProductController::class,
                'product-questions' => ProductQuestionController::class
            ]);


            Route::name('balance.withdrawal.admin.')->prefix('balance-withdrawal-admin')->group(function () {
                Route::get('/', [BalanceWithdrawalController::class, 'index'])->name('index');
                Route::put('/{balance_withdrawal}', [BalanceWithdrawalController::class, 'update'])->name('update');
                Route::put('/{balance_withdrawal}/disapprove', [BalanceWithdrawalController::class, 'disapprove'])->name('disapprove');
                Route::get('history-admin', [BalanceWithdrawalController::class, 'historyAdmin'])->name('history');
            });
            Route::patch('varian-products-update/{product}', [ProductController::class, 'varianProductUpdate'])->name('varian.products.update');
            Route::post('varian-products', [ProductController::class, 'varianProductStore'])->name('varian.products.store');

            // productEmail
            ROute::post('product-email/{product}', [ProductEmailController::class, 'store'])->name('product.email.store');

            // update-delete-varianProduct
            Route::patch('varian-products/{varianProduct}', [VarianProductController::class, 'update'])->name('update.varian.product');
            Route::delete('varian-products/{varianProduct}', [VarianProductController::class, 'destroy'])->name('delete.varian.product');

            // Route::resource('preorder-products', PreorderProductController::class)->only('index');

            Route::post('licenses-update', [LicenseController::class, 'licensesUpdate'])->name('licenses.update');
            Route::resource('licenses', LicenseController::class)->only('show', 'store', 'destroy');


            Route::name('product.')->prefix('product')->group(function () {
                Route::get('count-stock/{product}', [ProductController::class, 'getStockDetail'])->name('count.stocks');
                Route::delete('destroy/{product}', [DestroyProductController::class, 'destroy'])->name('destroy');
                Route::delete('soft-delete/{product}', [DestroyProductController::class, 'softDestroy'])->name('soft.delete');
            });


            // order
            Route::name('orders.')->group(function () {
                Route::prefix('orders')->group(function () {
                    Route::get('/', [OrderController::class, 'index'])->name('index');
                    Route::get('{invoice_id}', [OrderController::class, 'show'])->name('detail');
                    Route::post('{invoice_id}', [OrderController::class, 'update'])->name('update');
                });
            });

            Route::name('update.id.invoice.')->group(function () {
                Route::prefix('update-id-invoice')->group(function () {
                    Route::post('/', [UpdateIdInvoiceController::class, 'store'])->name('store');
                });
            });


            Route::name('users.')->prefix('users')->group(function () {
                Route::get('/', [UserController::class, 'create'])->name('create');
                Route::post('/', [UserController::class, 'store'])->name('store');
                Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
                Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
                Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('delete');
                Route::name('customer.')->prefix('customer')->group(function () {
                    Route::get('/', [CustomerController::class, 'index'])->name('index');
                    Route::patch('update/{user}', [CustomerController::class, 'update'])->name('update');
                    Route::delete('delete/{user}', [CustomerController::class, 'delete'])->name('destroy');
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
    Route::middleware('role:admin|administrator')->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::name('orders.')->group(function () {
                Route::get('order-histories', [OrderController::class, 'history'])->name('history');
                ROute::get('pending-histories', [OrderController::class, 'pendingHistories'])->name('pending');
                Route::get('/get-pending-histories', [OrderController::class, 'fetchPendingHistories'])->name('fetch-pending-histories');
                Route::get('/get-all-histories', [OrderController::class, 'fetchHistories'])->name('fetch-histories');
            });
            Route::name('revenues.')->prefix('revenues')->group(function () {
                Route::get('totalAmount', [RevenueController::class, 'totalAmount'])->name('totalAmount');
                Route::get('/', [RevenueController::class, 'index'])->name('index');
                Route::get('print', [RevenueController::class, 'printRevenue'])->name('print');
            });
        });
    });

    Route::middleware('role:reseller|customer')->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::name('dashboard.')->group(function () {
                Route::name('refund.')->prefix('refund')->group(function () {
                    Route::get('my-refund', [RefundController::class, 'getMyRefund'])->name('my.refund');
                });
            });
        });
    });
});

Route::fallback(function () {
    return view('errors.404');
});
