<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PrivacyPolicyFormRequest;
use App\Interfaces\Repositories\PrivacyPolicyRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    use AdminRolePermission;

    private PrivacyPolicyRepositoryInterface $privacyPolicyRepository;

    public function __construct(PrivacyPolicyRepositoryInterface $privacyPolicyRepository)
    {
        $this->privacyPolicyRepository = $privacyPolicyRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $privacypolicy = $this->privacyPolicyRepository->getPrivacyPolicyIndex();

        return view('admin.privacy-policy.edit', compact('privacypolicy'));
    }

    public function edit($id)
    {
        $privacypolicy = $this->privacyPolicyRepository->getPrivacyPolicyData($id);

        return view('admin.privacy-policy.edit', compact('privacypolicy'));
    }

    public function update(PrivacyPolicyFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->privacyPolicyRepository->savePrivacyPolicyData($request);

        return redirect('admin/privacy-policy')->with('flash_message', 'PrivacyPolicy updated!');
    }

}
