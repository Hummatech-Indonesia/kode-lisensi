<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Products\ProductEmailInterface;
use App\Http\Requests\ProductEmailStoreRequest;
use App\Models\Product;
use App\Observers\ProductEmailObserver;
use Illuminate\Http\Request;

class ProductEmailController extends Controller
{
    private ProductEmailInterface $productEmail;
    public function __construct(ProductEmailInterface $productEmail){
        $this->productEmail=$productEmail;
    }
    public function store(ProductEmailStoreRequest $request,Product $product){
        $data=$request->validated();
        $data['product_id'] = $product->id;
        $this->productEmail->store($data);
        return back();
        // return back()->with('success','Berhasil menambah data');
    }
}
