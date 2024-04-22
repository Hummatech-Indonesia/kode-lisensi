<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Administrator\TransactionWhatsappInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Http\Requests\TransactionWhatsappRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TransactionWhatsappController extends Controller
{
    private TransactionWhatsappInterface $transactionWhatsapp;
    private UserInterface $user;

    public function __construct(TransactionWhatsappInterface $transactionWhatsapp, UserInterface $user)
    {
        $this->transactionWhatsapp = $transactionWhatsapp;
        $this->user = $user;
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(TransactionWhatsappRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $user = $this->user->searchByEmail($data['email']);
        if ($user == null) {
            $user = $this->user->store([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt('password'),
                'phone_number' => $data['phone_number'],
                'email_verified_at' => now()
            ]);

            $user->assignRole($data['role']);
        }
        $data['user_id'] = $user;
        $this->transactionWhatsapp->store($data);
        return redirect()->back()->with('success', trans('alert.add_success'));
    }
}
