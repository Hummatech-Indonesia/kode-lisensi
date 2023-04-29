<?php

namespace App\Http\Controllers;

use App\Helpers\NotificationHelper;
use Illuminate\Http\RedirectResponse;

class NotificationController extends Controller
{
    /**
     * Handle mark as read notification
     *
     * @param string $take
     * @return RedirectResponse
     */

    public function index(string $take): RedirectResponse
    {
        NotificationHelper::take($take)
            ->markAsRead();

        return back();
    }
}
