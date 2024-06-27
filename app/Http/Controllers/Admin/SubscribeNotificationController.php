<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscribeNotificationFormRequest;
use App\Models\SubscribeNotification;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class SubscribeNotificationController extends Controller
{
    use AdminRolePermission;

    public function index(Request $request)
    {
        if($this->adminHasPermission('can_access_listing')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $subscribenotification = SubscribeNotification::first();

        return view('admin.subscribe-notification.edit', compact('subscribenotification'));
    }

    public function edit($id)
    {
        $subscribenotification = SubscribeNotification::findOrFail($id);

        return view('admin.subscribe-notification.edit', compact('subscribenotification'));
    }

    public function update(SubscribeNotificationFormRequest $request)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }
           
        $requestData = $request->all();
        $titles = [
            'en'   => $requestData['title_en'],
            'hant' => $requestData['title_hant'],
            'hans' => $requestData['title_hans'],
        ];
        $descriptions = [
            'en'   => $requestData['description_en'],
            'hant' => $requestData['description_hant'],
            'hans' => $requestData['description_hans'],
        ];
        $requestData['titles']       = $titles;
        $requestData['descriptions'] = $descriptions;

        $subscribenotification = SubscribeNotification::first();
        if ($subscribenotification) {
            $subscribenotification->update($requestData);
        } else {
            SubscribeNotification::create($requestData);
        }

        return redirect('admin/subscribe-notification')->with('flash_message', 'SubscribeNotification updated!');
    }
}
