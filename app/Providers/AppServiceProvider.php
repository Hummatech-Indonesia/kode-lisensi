<?php

namespace App\Providers;

use App\Contracts\Interfaces\AboutInterface;
use App\Contracts\Interfaces\AdminWithdrawalInterface;
use App\Contracts\Interfaces\ArticleCategoryInterface;
use App\Contracts\Interfaces\ArticleInterface;
use App\Contracts\Interfaces\BalanceWithdrawalInterface;
use App\Contracts\Interfaces\BannerInterface;
use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\ChangePasswordInterface;
use App\Contracts\Interfaces\ContactInterface;
use App\Contracts\Interfaces\CustomerInterface;
use App\Contracts\Interfaces\FcmTokenInterface;
use App\Contracts\Interfaces\HelpInterface;
use App\Contracts\Interfaces\LicenseInterface;
use App\Contracts\Interfaces\PinRekeningInterface;
use App\Contracts\Interfaces\ProductFavoriteInterface;
use App\Contracts\Interfaces\Products\ArchiveProductInterface;
use App\Contracts\Interfaces\Products\ProductEmailInterface;
use App\Contracts\Interfaces\Products\ProductInterface;
use App\Contracts\Interfaces\Products\ProductQuestionInterface;
use App\Contracts\Interfaces\Products\ProductRecommendationInterface;
use App\Contracts\Interfaces\Products\ProductRecommendationsInterface;
use App\Contracts\Interfaces\ProfileInterface;
use App\Contracts\Interfaces\RatingInterface;
use App\Contracts\Interfaces\RegisterInterface;
use App\Contracts\Interfaces\RekeningNumberInterface;
use App\Contracts\Interfaces\ResellerInterface;
use App\Contracts\Interfaces\SiteSettingInterface;
use App\Contracts\Interfaces\SliderInterface;
use App\Contracts\Interfaces\TermInterface;
use App\Contracts\Interfaces\TransactionAffiliateInterface;
use App\Contracts\Interfaces\TransactionInterface;
use App\Contracts\Interfaces\UpdateIdInvoiceInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Contracts\Interfaces\VarianProductInterface;
use App\Contracts\Repositories\AboutRepository;
use App\Contracts\Repositories\AdminWithdrawalRepository;
use App\Contracts\Repositories\ArticleCategoryRepository;
use App\Contracts\Repositories\ArticleRepository;
use App\Contracts\Repositories\BalanceWithdrawalRepository;
use App\Contracts\Repositories\BannerRepository;
use App\Contracts\Repositories\CategoryRepository;
use App\Contracts\Repositories\ChangePasswordRepository;
use App\Contracts\Repositories\ContactRepository;
use App\Contracts\Repositories\CustomerRepository;
use App\Contracts\Repositories\FcmTokenRepository;
use App\Contracts\Repositories\HelpRepository;
use App\Contracts\Repositories\LicenseRepository;
use App\Contracts\Repositories\PinRekeningRepository;
use App\Contracts\Repositories\ProductFavoriteRepository;
use App\Contracts\Repositories\Products\ArchiveProductRepository;
use App\Contracts\Repositories\Products\ProductEmailRepository;
use App\Contracts\Repositories\Products\ProductQuestionRepository;
use App\Contracts\Repositories\Products\ProductRecommendationRepository;
use App\Contracts\Repositories\Products\ProductRepository;
use App\Contracts\Repositories\ProfileRepository;
use App\Contracts\Repositories\RatingRepository;
use App\Contracts\Repositories\RegisterRepository;
use App\Contracts\Repositories\RekeningNumberRepository;
use App\Contracts\Repositories\ResellerRepository;
use App\Contracts\Repositories\SiteSettingRepository;
use App\Contracts\Repositories\SliderRepository;
use App\Contracts\Repositories\TermRepository;
use App\Contracts\Repositories\TransactionAffiliateRepository;
use App\Contracts\Repositories\TransactionRepository;
use App\Contracts\Repositories\UpdateIdInvoiceRepository;
use App\Contracts\Repositories\UserRepository;
use App\Contracts\Repositories\VarianProductRepository;
use App\Http\Requests\FcmTokenRequest;
use App\Models\Category;
use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Auth\UserInfo;

class AppServiceProvider extends ServiceProvider
{
    private array $register = [
        CategoryInterface::class => CategoryRepository::class,
        ProfileInterface::class => ProfileRepository::class,
        ChangePasswordInterface::class => ChangePasswordRepository::class,
        CustomerInterface::class => CustomerRepository::class,
        ResellerInterface::class => ResellerRepository::class,
        ProductInterface::class => ProductRepository::class,
        ArchiveProductInterface::class => ArchiveProductRepository::class,
        LicenseInterface::class => LicenseRepository::class,
        RegisterInterface::class => RegisterRepository::class,
        SiteSettingInterface::class => SiteSettingRepository::class,
        HelpInterface::class => HelpRepository::class,
        TermInterface::class => TermRepository::class,
        ProductQuestionInterface::class => ProductQuestionRepository::class,
        AboutInterface::class => AboutRepository::class,
        ContactInterface::class => ContactRepository::class,
        TransactionInterface::class => TransactionRepository::class,
        RatingInterface::class => RatingRepository::class,
        ArticleInterface::class => ArticleRepository::class,
        ArticleCategoryInterface::class => ArticleCategoryRepository::class,
        SliderInterface::class => SliderRepository::class,
        BannerInterface::class => BannerRepository::class,
        ProductFavoriteInterface::class => ProductFavoriteRepository::class,
        FcmTokenInterface::class => FcmTokenRepository::class,
        TransactionAffiliateInterface::class => TransactionAffiliateRepository::class,
        UserInterface::class => UserRepository::class,
        VarianProductInterface::class => VarianProductRepository::class,
        ProductEmailInterface::class => ProductEmailRepository::class,
        UpdateIdInvoiceInterface::class => UpdateIdInvoiceRepository::class,
        PinRekeningInterface::class => PinRekeningRepository::class,
        BalanceWithdrawalInterface::class => BalanceWithdrawalRepository::class,
        AdminWithdrawalInterface::class => AdminWithdrawalRepository::class,
        RekeningNumberInterface::class => RekeningNumberRepository::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        foreach ($this->register as $index => $value) $this->app->bind($index, $value);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $view->with('site', SiteSetting::query()->first());
            $view->with('nav_categories', Category::query()->with('products')->get());
        });
    }
}
