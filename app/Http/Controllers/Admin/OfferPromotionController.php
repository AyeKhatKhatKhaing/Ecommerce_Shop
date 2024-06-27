<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OfferPromotionFormRequest;
use App\Interfaces\Repositories\OfferPromotionRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class OfferPromotionController extends Controller
{
    use AdminRolePermission;

    private OfferPromotionRepositoryInterface $offerPromotionRepository;

    public function __construct(OfferPromotionRepositoryInterface $offerPromotionRepository)
    {
        $this->offerPromotionRepository = $offerPromotionRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->offerPromotionRepository->getAllOfferPromotionList($request);

        return view('admin.offer-promotion.index', $data);
    }

    public function create()
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        return view('admin.offer-promotion.create');
    }

    public function store(OfferPromotionFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->offerPromotionRepository->saveOfferPromotionData($request);

        return redirect('admin/offer-promotion')->with('flash_message', 'OfferPromotion added!');
    }

    public function edit($id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $offerpromotion = $this->offerPromotionRepository->getOfferPromotionData($id);

        return view('admin.offer-promotion.edit', compact('offerpromotion'));
    }

    public function update(OfferPromotionFormRequest $request, $id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->offerPromotionRepository->saveOfferPromotionData($request, $id);

        return redirect('admin/offer-promotion')->with('flash_message', 'OfferPromotion updated!');
    }

    public function destroy($id)
    {
        if ($this->adminHasPermission('can_access_delete')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->offerPromotionRepository->deleteOfferPromotion($id);

        return redirect('admin/offer-promotion')->with('flash_message', 'OfferPromotion deleted!');
    }

    public function statusChange(Request $request)
    {
        $offerpromotion = $this->offerPromotionRepository->offerPromotionStatusChange($request);

        return response()->json([
            "success"   => true,
            'isPublish' => $offerpromotion->status,
            'id'        => $offerpromotion->id,
        ]);
    }
}
