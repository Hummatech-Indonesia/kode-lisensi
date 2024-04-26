<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Administrator\ExpenditureInterface;
use App\Http\Requests\ExpenditureRequest;
use App\Models\Expenditure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExpenditureController extends Controller
{
    private ExpenditureInterface $expenditure;
    public function __construct(ExpenditureInterface $expenditure)
    {
        $this->expenditure = $expenditure;
    }
    /**
     * Method index
     *
     * @return void
     */
    public function index(): View
    {
        $expenditures = $this->expenditure->get();
        return view('dashboard.pages.administrator.expenditure.index', compact('expenditures'));
    }
    /**
     * Method fetchExpenditure
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function fetchExpenditure(Request $request): View|JsonResponse
    {
        if ($request->ajax())
            return $this->expenditure->getAll();
        return view('dashboard.pages.administrator.expenditure.index');
    }
    /**
     * Method store
     *
     * @param ExpenditureRequest $request [explicite description]
     *
     * @return void
     */
    public function store(ExpenditureRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['balance_withdrawn'] = intval($data['balance_withdrawn']);
        $this->expenditure->store($data);
        return back()->with('success', 'Berhasil menambah data');
    }
    /**
     * Method update
     *
     * @param ExpenditureRequest $request [explicite description]
     * @param Expenditure $expenditure [explicite description]
     *
     * @return void
     */
    public function update(ExpenditureRequest $request, Expenditure $expenditure): RedirectResponse
    {
        $this->expenditure->update($expenditure->id, $request->validated());
        return back()->with('success', 'Berhasil mengubah data');
    }
    /**
     * Method destroy
     *
     * @param Expenditure $expenditure [explicite description]
     *
     * @return void
     */
    public function destroy(Expenditure $expenditure): RedirectResponse
    {
        $this->expenditure->delete($expenditure->id);
        return back()->with('success', 'Berhasil menghapus data');
    }
}
