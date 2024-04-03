<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\BalanceWithdrawal;
use App\Models\Category;
use App\Models\License;
use App\Models\Product;
use App\Models\ProductEmail;
use App\Models\ProductFavorite;
use App\Models\ProductRecommendation;
use App\Models\RekeningNumber;
use App\Models\ShareProductReseller;
use App\Models\TransactionAffiliate;
use App\Models\User;
use App\Models\VarianProduct;
use App\Observers\ArticleObserver;
use App\Observers\BalanceWithdrawalObserver;
use App\Observers\CategoryObserver;
use App\Observers\LicenseObserver;
use App\Observers\ProductEmailObserver;
use App\Observers\ProductFavoriteObserver;
use App\Observers\ProductObserver;
use App\Observers\ProductRecommendationObserver;
use App\Observers\RekeningNumberObserver;
use App\Observers\ShareProductReselllerObserver;
use App\Observers\TransactionAffiliateObserver;
use App\Observers\UserObserver;
use App\Observers\VarianProductObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        Product::observe(ProductObserver::class);
        License::observe(LicenseObserver::class);
        User::observe(UserObserver::class);
        Article::observe(ArticleObserver::class);
        ProductFavorite::observe(ProductFavoriteObserver::class);
        ShareProductReseller::observe(ShareProductReselllerObserver::class);
        VarianProduct::observe(VarianProductObserver::class);
        ProductEmail::observe(ProductEmailObserver::class);
        TransactionAffiliate::observe(TransactionAffiliateObserver::class);
        BalanceWithdrawal::observe(BalanceWithdrawalObserver::class);
        RekeningNumber::observe(RekeningNumberObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
