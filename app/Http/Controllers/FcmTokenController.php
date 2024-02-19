<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\FcmTokenInterface;
use App\Helpers\ResponseHelper;
use App\Http\Requests\FcmTokenRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FcmTokenController extends Controller
{
    private FcmTokenInterface $fcmToken;

    public function __construct(FcmTokenInterface $fcmToken)
    {
        $this->fcmToken = $fcmToken;
    }

    /**
     * store
     *
     * @return JsonResponse
     */
    public function update(FcmTokenRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->fcmToken->update(auth()->user()->id, $data);
        return ResponseHelper::success(null, trans('alert.update_success'));
    }

    /**
     * delete
     *
     * @return JsonResponse
     */
    public function delete(): JsonResponse
    {
        $this->fcmToken->update(auth()->user()->id, ['fcm_token' => null]);
        return ResponseHelper::success(null, trans('alert.update_success'));
    }
}
