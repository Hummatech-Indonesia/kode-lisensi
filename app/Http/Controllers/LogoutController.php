<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\FcmTokenInterface;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    private FcmTokenInterface $fcmToken;

    public function __construct(FcmTokenInterface $fcmToken)
    {
        $this->fcmToken = $fcmToken;
    }
    /**
     * logout
     *
     * @return void
     */
    public function logout()
    {
        $this->fcmToken->update(auth()->user()->id, ['fcm_token' => null]);
        auth()->user()->currentAccessToken()->delete();
        return ResponseHelper::success(auth()->user()->token, 'sukses logout');
    }
}
