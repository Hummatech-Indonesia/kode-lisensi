<?php

namespace App\Providers;

use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\ChangePasswordInterface;
use App\Contracts\Interfaces\CustomerInterface;
use App\Contracts\Interfaces\Products\ArchiveProductInterface;
use App\Contracts\Interfaces\Products\ProductInterface;
use App\Contracts\Interfaces\ProfileInterface;
use App\Contracts\Interfaces\ResellerInterface;
use App\Contracts\Repositories\CategoryRepository;
use App\Contracts\Repositories\ChangePasswordRepository;
use App\Contracts\Repositories\CustomerRepository;
use App\Contracts\Repositories\Products\ArchiveProductRepository;
use App\Contracts\Repositories\Products\ProductRepository;
use App\Contracts\Repositories\ProfileRepository;
use App\Contracts\Repositories\ResellerRepository;
use App\Helpers\CurrencyHelper;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProfileInterface::class, ProfileRepository::class);
        $this->app->bind(ChangePasswordInterface::class, ChangePasswordRepository::class);
        $this->app->bind(CustomerInterface::class, CustomerRepository::class);
        $this->app->bind(ResellerInterface::class, ResellerRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(ArchiveProductInterface::class, ArchiveProductRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Blade::directive('currency', function ($expression) {
            return CurrencyHelper::rupiahCurrency($expression);
        });
    }
}
