<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactPageRequest;
use App\Interfaces\Repositories\ContactPageRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    use AdminRolePermission;

    private ContactPageRepositoryInterface $contactPageRepository;

    public function __construct(ContactPageRepositoryInterface $contactPageRepository)
    {
        $this->contactPageRepository = $contactPageRepository;
    }
    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $contactpage = $this->contactPageRepository->getContactPageIndex($request);

        return view('admin.contact-page.edit', compact('contactpage'));
    }

    public function edit($id)
    {
        $contactpage = $this->contactPageRepository->getContactPageData($id);

        return view('admin.contact-page.edit', compact('contactpage'));
    }

    public function update(ContactPageRequest $request)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->contactPageRepository->saveContactPageData($request);

        return redirect('admin/contact-page')->with('flash_message', 'ContactPage updated!');
    }

}
