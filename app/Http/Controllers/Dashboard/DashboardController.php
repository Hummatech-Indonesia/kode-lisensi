<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\ArticleCategoryInterface;
use App\Contracts\Interfaces\ArticleInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Enums\UserRoleEnum;
use App\Helpers\BalanceHelper;
use App\Helpers\ResponseHelper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Services\SummaryService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private SummaryService $service;
    private ArticleInterface $article;
    private ArticleCategoryInterface $articleCategory;
    private UserInterface $user;

    public function __construct(SummaryService $service, ArticleInterface $article, ArticleCategoryInterface $articleCategory, UserInterface $user)
    {
        $this->user = $user;
        $this->service = $service;
        $this->article = $article;
        $this->articleCategory = $articleCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        if (UserHelper::getUserRole() === UserRoleEnum::ADMIN->value) {
            return view('dashboard.pages.index', [
                'balance' => BalanceHelper::handleBalance(),
                'revenue' => BalanceHelper::handleRevenue(),
                'order' => $this->service->handleCountOrders(),
                'product' => $this->service->handleCountProducts(),
                'customer' => $this->service->handleCountCustomers(),
                'pieChart' => $this->service->handlePieChart(),
                'lowStockProduct' => $this->service->handleLowStockProducts(),
                'lineChart' => $this->service->handleLineChart(),
                'latestTransaction' => $this->service->handleLatestTransaction(),
                'bestSeller' => $this->service->handleBestSeller()
            ]);
        } elseif (UserHelper::getUserRole() === UserRoleEnum::RESELLER->value) {

            return view('dashboard.pages.reseller-dashboard.index');
        } else if (UserHelper::getUserRole() === UserRoleEnum::ADMINISTRATOR->value) {

            $users = $this->user->userTransaction();

            return view('dashboard.pages.administrator.index', [
                'users' => $users,
                'balance' => BalanceHelper::handleBalance(),
                'expenditure' => BalanceHelper::overallExpenditure(),
                'tripayExpenditure' => BalanceHelper::tripayExpenditure(),
                'rekeningExpenditure' => BalanceHelper::rekeningExpenditure(),
                'revenue' => BalanceHelper::handleRevenue(),
                'tripayBalance' => BalanceHelper::handleTripayBalance(),
                'tripayRevenue' => BalanceHelper::handleTripayRevenue(),
                'whatsappBalance' => BalanceHelper::handleWhatsappBalance(),
                'whatsappRevenue' => BalanceHelper::handleWhatsappRevenue(),
            ]);
        } else {
            $totalArticle = $this->article->count();
            $totalArticleCategory = $this->articleCategory->count();
            $articles = $this->article->getByUser();
            $view = 0;
            foreach ($articles as $article) {
                $view += $article->view;
            }
            return view('dashboard.pages.author.dashboard.index', compact('totalArticle', 'totalArticleCategory', 'articles', 'view'));
        }
    }

    /**
     * apiDashboard
     *
     * @return JsonResponse
     */
    public function apiDashboard(): JsonResponse
    {
        $balance = BalanceHelper::handleBalance();
        $balance = strval($balance);
        $order = $this->service->handleCountOrders();
        $order = strval($order);
        $product = $this->service->handleCountProducts();
        $product = strval($product);
        $customer = $this->service->handleCountCustomers();
        $customer = strval($customer);
        $pieChart = $this->service->handlePieChart();
        $lowStockProduct = $this->service->handleLowStockProducts();
        $lineChart = $this->service->handleLineChart();
        $latestTransaction = $this->service->handleLatestTransaction();
        $bestSeller = $this->service->handleBestSeller();
        return ResponseHelper::success(['balance' => $balance, 'order' => $order, 'product' => $product, 'customer' => $customer, 'pieChart' => $pieChart, 'lowStockProduct' => $lowStockProduct, 'lineChart' => $lineChart, 'latestTransaction' => $latestTransaction, 'bestSeller' => $bestSeller]);
    }
}
