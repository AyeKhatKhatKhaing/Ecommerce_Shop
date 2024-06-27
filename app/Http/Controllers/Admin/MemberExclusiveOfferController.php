<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MemberExclusiveOfferFormRequest;
use App\Interfaces\Repositories\MemberExclusiveOfferRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class MemberExclusiveOfferController extends Controller
{
    use AdminRolePermission;

    private MemberExclusiveOfferRepositoryInterface $memberExclusiveOfferRepository;

    public function __construct(MemberExclusiveOfferRepositoryInterface $memberExclusiveOfferRepository)
    {
        $this->memberExclusiveOfferRepository = $memberExclusiveOfferRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $memberexclusiveoffer = $this->memberExclusiveOfferRepository->getMemberExclusiveOfferIndex();

        return view('admin.member-exclusive-offer.edit', compact('memberexclusiveoffer'));
    }

    public function edit($id)
    {
        $memberexclusiveoffer = $this->memberExclusiveOfferRepository->getMemberExclusiveOfferData($id);

        return view('admin.member-exclusive-offer.edit', compact('memberexclusiveoffer'));
    }

    public function update(MemberExclusiveOfferFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->memberExclusiveOfferRepository->saveMemberExclusiveOfferData($request);

        return redirect('admin/member-exclusive-offer')->with('flash_message', 'MemberExclusiveOffer updated!');
    }

}
