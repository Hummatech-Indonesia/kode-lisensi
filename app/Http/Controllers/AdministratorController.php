<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Products\ProductInterface;
use App\Models\Product;
use App\Services\TripayService;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    
    public function index()
    {
        return view('dashboard.pages.administrator.index');
    }
    public function create()
    {
        $products=Product::get();
        return view('dashboard.pages.administrator.add',compact('products'));
    }
}
