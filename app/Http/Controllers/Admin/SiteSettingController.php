<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    use AdminRolePermission;

    public function index(Request $request)
    {
        if($this->adminHasPermission('can_access_listing')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $site_setting = SiteSetting::get();

        return view('admin.site-setting.edit', compact('site_setting'));
    }

    public function edit($id)
    {
        $site_setting = SiteSetting::findOrFail($id);

        return view('admin.site-setting.edit', compact('site_setting'));
    }

    public function update(Request $request)
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }
        
        $data         = [];
        $types        = $request->types;
        $site_setting = SiteSetting::get();

        if (isset($site_setting) && count($site_setting) > 0) {
            foreach ($types as $key => $type) {
                $data = [
                    'type'       => $type,
                    'updated_by' => auth()->user()->id,
                ];
                if ($type == 'basic') {
                    $options = [
                        'en_law'      => $request->en_law,
                        'hant_law'    => $request->hant_law,
                        'hans_law'    => $request->hans_law,
                        'hk_whatsapp' => $request->hk_whatsapp,
                        'ma_whatsapp' => $request->ma_whatsapp,
                    ];

                    $data['options'] = $options;
                    $site_setting[$key]->update($data);
                }

                if ($type == 'currency') {
                    $options = [
                        'hk_rate' => $request->hk_rate,
                        'ma_rate' => $request->ma_rate,
                    ];

                    $data['options'] = $options;
                    $site_setting[$key]->update($data);
                }

                if ($type == 'contact') {
                    $options = [
                        'contact_email' => $request->contact_email,
                        'hk_phone'      => $request->hk_phone,
                        'hk_email'      => $request->hk_email,
                        'ma_phone'      => $request->ma_phone,
                        'ma_email'      => $request->ma_email,
                    ];

                    $data['options'] = $options;
                    $site_setting[$key]->update($data);
                }

                if ($type == 'register') {
                    $options = [
                        'en_privacy'           => $request->en_privacy,
                        'hant_privacy'         => $request->hant_privacy,
                        'hans_privacy'         => $request->hans_privacy,
                        'en_register_law'      => $request->en_register_law,
                        'hant_register_law'    => $request->hant_register_law,
                        'hans_register_law'    => $request->hans_register_law,
                    ];

                    $data['options'] = $options;
                    if (isset($site_setting[$key])) {
                        $site_setting[$key]->update($data);
                    } else {
                        $site_setting    = SiteSetting::create($data);
                    }
                        
                }
            }
        } else {
            foreach ($types as $key => $type) {
                $data = [
                    'type'       => $type,
                    'updated_by' => auth()->user()->id,
                ];
                if ($type == 'basic') {
                    $options = [
                        'en_law'      => $request->en_law,
                        'hant_law'    => $request->hant_law,
                        'hans_law'    => $request->hans_law,
                        'hk_whatsapp' => $request->hk_whatsapp,
                        'ma_whatsapp' => $request->ma_whatsapp,
                    ];

                    $data['options'] = $options;
                    $site_setting    = SiteSetting::create($data);
                }

                if ($type == 'currency') {
                    $options = [
                        'hk_rate' => $request->hk_rate,
                        'ma_rate' => $request->ma_rate,
                    ];

                    $data['options'] = $options;
                    $site_setting    = SiteSetting::create($data);
                }

                if ($type == 'contact') {
                    $options = [
                        'contact_email' => $request->contact_email,
                        'hk_phone'      => $request->hk_phone,
                        'hk_email'      => $request->hk_email,
                        'ma_phone'      => $request->ma_phone,
                        'ma_email'      => $request->ma_email,
                    ];

                    $data['options'] = $options;
                    $site_setting    = SiteSetting::create($data);
                }

                if ($type == 'register') {
                    $options = [
                        'en_privacy'           => $request->en_privacy,
                        'hant_privacy'         => $request->hant_privacy,
                        'hans_privacy'         => $request->hans_privacy,
                        'en_register_law'      => $request->en_register_law,
                        'hant_register_law'    => $request->hant_register_law,
                        'hans_register_law'    => $request->hans_register_law,
                    ];

                    $data['options'] = $options;
                    $site_setting    = SiteSetting::create($data);
                }
            }
        }

        return redirect()->back()->with('flash_message', 'Site Setting Added Successfully');

    }
}
