<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\RekeningNumberInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\RekeningNumberRequest;
use App\Mail\RekeningNumberMail;
use App\Models\RekeningNumber;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RekeningNumberController extends Controller
{


    private RekeningNumberInterface $rekeningNumber;

    public function __construct(RekeningNumberInterface $rekeningNumber)
    {
        $this->rekeningNumber = $rekeningNumber;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(RekeningNumber $rekeningNumber): RedirectResponse
    {
        $rekeningNumber->update(['status' => 1]);
        return redirect()->route('dashboard.balance.withdrawal.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RekeningNumberRequest $request): RedirectResponse
    {
        $rekeningNumber = $this->rekeningNumber->store($request->validated());
        $email = auth()->user()->email;
        Mail::to($email)->send(new RekeningNumberMail([
            'user' => auth()->user(),
            'id' => $rekeningNumber->id,
            'name' => $request->name,
            'rekening' => $request->rekening,
            'rekening_number' => $request->rekening_number,
            'time' => now()
        ]));
        return redirect()->back()->with('success', trans('mail.rekening_number'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RekeningNumberRequest $request, RekeningNumber $rekeningNumber): RedirectResponse
    {
        $this->rekeningNumber->update($rekeningNumber->id, $request->validated());
        return redirect()->back()->with('success', 'Berhasil memperbarui data rekening');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RekeningNumber $rekeningNumber): RedirectResponse
    {
        $this->rekeningNumber->delete($rekeningNumber->id);
        return redirect()->back()->with('success', 'Berhasil menghapus data rekening');
    }

}
