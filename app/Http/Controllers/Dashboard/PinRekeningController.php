<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\PinRekeningInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\PinRekeningRequest;
use App\Mail\PinRekeningMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PinRekeningController extends Controller
{
    private PinRekeningInterface $pinRekening;

    public function __construct(PinRekeningInterface $pinRekening)
    {
        $this->pinRekening = $pinRekening;
    }

    /**
     * sendEmail
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function sendEmail(PinRekeningRequest $request): RedirectResponse
    {
        $email = auth()->user()->email;
        Mail::to($email)->send(new PinRekeningMail([
            'user' => auth()->user(),
            'pin' => $request->pin,
            'time' => now(),
        ]));
        return redirect()->back()->with('success', trans('mail.pin_rekening'));
    }

    /**
     * index
     *
     * @return RedirectResponse
     */
    public function index(int $pin, string $id): RedirectResponse
    {
        $this->pinRekening->store([
            'user_id' => $id,
            'pin' => $pin,
        ]);
        return to_route('dashboard.balance.withdrawal.index');
    }
}
