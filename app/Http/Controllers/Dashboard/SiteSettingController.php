<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\SiteSettingInterface;
use App\Enums\UploadDiskEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SiteSettingRequest;
use App\Models\SiteSetting;
use App\Services\SiteSettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    private SiteSettingService $siteSettingService;
    private SiteSettingInterface $setting;

    public function __construct(SiteSettingService $siteSettingService, SiteSettingInterface $setting)
    {
        $this->siteSettingService = $siteSettingService;
        $this->setting = $setting;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $data = $this->setting->get();
        return view('dashboard.pages.configuration.site-setting.index', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SiteSettingRequest $request
     * @param SiteSetting $site_setting
     *
     * @return RedirectResponse
     */
    public function update(SiteSettingRequest $request, SiteSetting $site_setting): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $upload = $this->siteSettingService->validateAndUpload(UploadDiskEnum::SITE_SETTING->value, $request->file('logo'), $site_setting->logo);
        }

        $this->setting->update($site_setting->id, [
            'name' => $data['name'],
            'description' => $data['description'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'logo' => $upload ?? $site_setting->logo,
            'facebook' => $data['facebook'],
            'twitter' => $data['twitter'],
            'youtube' => $data['youtube'],
            'instagram' => $data['instagram']
        ]);

        return back()->with('success', trans('alert.update_success'));
    }

}
