<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Administrator\TransactionWhatsappInterface;
use App\Contracts\Interfaces\Products\ProductInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Http\Requests\TransactionWhatsappRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TransactionWhatsappController extends Controller
{
    private TransactionWhatsappInterface $transactionWhatsapp;
    private ProductInterface $product;
    private UserInterface $user;

    public function __construct(TransactionWhatsappInterface $transactionWhatsapp, UserInterface $user, ProductInterface $product)
    {
        $this->transactionWhatsapp = $transactionWhatsapp;
        $this->product = $product;
        $this->user = $user;
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(TransactionWhatsappRequest $request, string $slug = null, string $slug_varian = null): RedirectResponse
    {
        $data = $request->validated();
        $user = $this->user->searchByEmail($data['email']);
        if ($user == null) {
            $user = $this->user->store([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt('password'),
                'role' => $data['role'],
                'phone_number' => $data['phone_number'],
                'email_verified_at' => now(),
                'payment_method' => $data['payment_code']
            ]);

            $user->assignRole($data['role']);
        }
        $product = $this->product->getWhere(['slug' => $slug, 'slug_varian' => $slug_varian]);
        $data['product_id'] = $product->id;
        $data['user_id'] = $user->id;
        $this->transactionWhatsapp->store($data);
        return redirect()->back()->with('success', trans('alert.add_success'));
    }
}
