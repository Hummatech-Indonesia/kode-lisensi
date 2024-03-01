<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\VarianProductInterface;
use App\Http\Requests\VarianProductStoreRequest;
use App\Http\Requests\VarianProductUpdateModalRequest;
use App\Models\VarianProduct;
use Illuminate\Http\Request;

class VarianProductController extends Controller
{

    private VarianProductInterface $varianProduct;
    public function __construct(VarianProductInterface $varianProduct){
        $this->varianProduct=$varianProduct;
    }
    public function index(){

    }

    public function update(VarianProductUpdateModalRequest $request,VarianProduct $varianProduct){
        $this->varianProduct->update($varianProduct->id,$request->validated());
        return redirect()->back();
    }
    public function destroy(VarianProduct $varianProduct){
        $this->varianProduct->delete($varianProduct->id);
        return redirect()->back();
    }
}
