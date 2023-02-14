<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\ProfileInterface;
use App\Enums\UploadDiskEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProfileRequest;
use App\Models\User;
use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    private ProfileService $profileService;
    private ProfileInterface $profile;

    public function __construct(ProfileService $profileService, ProfileInterface $profile)
    {
        $this->profileService = $profileService;
        $this->profile = $profile;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */

    public function index(): View
    {
        $user = $this->profile->get();

        return view('dashboard.pages.profile.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileRequest $request
     * @param User $profile
     * @return RedirectResponse
     */
    public function update(ProfileRequest $request, User $profile): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $photo = $this->profileService->validateAndUpload(UploadDiskEnum::PROFILES->value, $request->file('photo'), $profile->photo);
        }

        $this->profile->update($profile->id, [
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'photo' => $photo ?? null
        ]);

        return back()->with('success', trans('alert.profile_updated'));
    }
}
