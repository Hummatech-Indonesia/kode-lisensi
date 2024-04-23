<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Products\ProductInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Models\Product;
use App\Services\TripayService;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    private UserInterface $user;
    public function __construct(UserInterface $user){
        $this->user=$user;
    }
    public function index()
    {
        $users=$this->user->userTransaction();
        return view('dashboard.pages.administrator.index',compact('users'));
    }
    public function create()
    {
        $products=Product::get();
        return view('dashboard.pages.administrator.add',compact('products'));
    }
}
