<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExclusiveOfferFormRequest;
use App\Interfaces\Repositories\ExclusiveOfferRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class ExclusiveOfferController extends Controller
{
    use AdminRolePermission;

    private ExclusiveOfferRepositoryInterface $exclusiveOfferRepository;

    public function __construct(ExclusiveOfferRepositoryInterface $exclusiveOfferRepository)
    {
        $this->exclusiveOfferRepository = $exclusiveOfferRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->exclusiveOfferRepository->getAllExclusiveOfferList($request);

        return view('admin.exclusive-offer.index', $data);
    }

    public function create()
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        return view('admin.exclusive-offer.create');
    }

    public function store(ExclusiveOfferFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->exclusiveOfferRepository->saveExclusiveOfferData($request);

        return redirect('admin/exclusive-offer')->with('flash_message', 'ExclusiveOffer added!');
    }

    public function edit($id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $exclusiveoffer = $this->exclusiveOfferRepository->getExclusiveOfferData($id);

        return view('admin.exclusive-offer.edit', compact('exclusiveoffer'));
    }

    public function update(ExclusiveOfferFormRequest $request, $id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->exclusiveOfferRepository->saveExclusiveOfferData($request, $id);

        return redirect('admin/exclusive-offer')->with('flash_message', 'ExclusiveOffer updated!');
    }

    public function destroy($id)
    {
        if ($this->adminHasPermission('can_access_delete')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->exclusiveOfferRepository->deleteExclusiveOffer($id);

        return redirect('admin/exclusive-offer')->with('flash_message', 'ExclusiveOffer deleted!');
    }

    public function statusChange(Request $request)
    {
        $exclusiveoffer = $this->exclusiveOfferRepository->exclusiveOfferStatusChange($request);

        return response()->json([
            "success"   => true,
            'isPublish' => $exclusiveoffer->status,
            'id'        => $exclusiveoffer->id,
        ]);
    }
}
