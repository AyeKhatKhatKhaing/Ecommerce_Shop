<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PromotionFormRequest;
use App\Interfaces\Repositories\PromotionRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    use AdminRolePermission;

    private PromotionRepositoryInterface $promotionRepository;

    public function __construct(PromotionRepositoryInterface $promotionRepository)
    {
        $this->promotionRepository = $promotionRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->promotionRepository->getAllPromotionList($request);

        return view('admin.promotion.index', $data);
    }

    public function create()
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        return view('admin.promotion.create');
    }

    public function store(PromotionFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->promotionRepository->savePromotionData($request);

        return redirect('admin/promotion')->with('flash_message', 'Promotion added!');
    }

    public function edit($id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $promotion = $this->promotionRepository->getPromotionData($id);

        return view('admin.promotion.edit', compact('promotion'));
    }

    public function update(PromotionFormRequest $request, $id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->promotionRepository->savePromotionData($request, $id);

        return redirect('admin/promotion')->with('flash_message', 'Promotion updated!');
    }

    public function destroy($id)
    {
        if ($this->adminHasPermission('can_access_delete')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->promotionRepository->deletePromotion($id);

        return redirect('admin/promotion')->with('flash_message', 'Promotion deleted!');
    }

    public function statusChange(Request $request)
    {
        $promotion = $this->promotionRepository->promotionStatusChange($request);

        return response()->json([
            "success"   => true,
            'isPublish' => $promotion->status,
            'id'        => $promotion->id,
        ]);

    }
}
