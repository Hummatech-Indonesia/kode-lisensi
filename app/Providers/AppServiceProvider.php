<?php

namespace App\Providers;

use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\ChangePasswordInterface;
use App\Contracts\Interfaces\CustomerInterface;
use App\Contracts\Interfaces\HelpInterface;
use App\Contracts\Interfaces\LicenseInterface;
use App\Contracts\Interfaces\Products\ArchiveProductInterface;
use App\Contracts\Interfaces\Products\ProductInterface;
use App\Contracts\Interfaces\ProfileInterface;
use App\Contracts\Interfaces\RegisterInterface;
use App\Contracts\Interfaces\ResellerInterface;
use App\Contracts\Interfaces\SiteSettingInterface;
use App\Contracts\Interfaces\TermInterface;
use App\Contracts\Repositories\CategoryRepository;
use App\Contracts\Repositories\ChangePasswordRepository;
use App\Contracts\Repositories\CustomerRepository;
use App\Contracts\Repositories\HelpRepository;
use App\Contracts\Repositories\LicenseRepository;
use App\Contracts\Repositories\Products\ArchiveProductRepository;
use App\Contracts\Repositories\Products\ProductRepository;
use App\Contracts\Repositories\ProfileRepository;
use App\Contracts\Repositories\RegisterRepository;
use App\Contracts\Repositories\ResellerRepository;
use App\Contracts\Repositories\SiteSettingRepository;
use App\Contracts\Repositories\TermRepository;
use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;

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
        TermInterface::class => TermRepository::class
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
        });
    }
}
