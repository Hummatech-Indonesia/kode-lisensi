<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Administrator\ExpenditureInterface;
use App\Http\Requests\ExpenditureRequest;
use App\Models\Expenditure;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
{
    private ExpenditureInterface $expenditure;
    public function __construct(ExpenditureInterface $expenditure){
        $this->expenditure=$expenditure;
    }
    public function index(){
        $expenditures=$this->expenditure->get();
        return view('dashboard.pages.administrator.expenditure.index',compact('expenditures'));
    }
    public function store(ExpenditureRequest $request){
        $this->expenditure->store($request->validated());
        return back()->with('success','Berhasil menambah data');
    }
    public function update(ExpenditureRequest $request,Expenditure $expenditure){
        $this->expenditure->update($request->validated(),$expenditure->id);
        return back()->with('success','Berhasil mengubah data');
    }
    public function destroy(Expenditure $expenditure){
        $this->expenditure->delete($expenditure->id);
        return back()->with('success','Berhasil menghapus data');
    }
}
