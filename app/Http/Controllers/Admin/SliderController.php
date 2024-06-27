<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderFormRequest;
use App\Interfaces\Repositories\SliderRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use AdminRolePermission;

    private SliderRepositoryInterface $sliderRepository;

    public function __construct(SliderRepositoryInterface $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->sliderRepository->getAllSliderList($request);

        return view('admin.slider.index', $data);
    }

    public function create()
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        return view('admin.slider.create');
    }

    public function store(SliderFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->sliderRepository->saveSliderData($request);

        return redirect('admin/slider')->with('flash_message', 'Slider added!');
    }

    public function edit($id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $slider = $this->sliderRepository->getSliderData($id);

        return view('admin.slider.edit', compact('slider'));
    }

    public function update(SliderFormRequest $request, $id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->sliderRepository->saveSliderData($request, $id);

        return redirect('admin/slider')->with('flash_message', 'Slider updated!');
    }

    public function destroy($id)
    {
        if ($this->adminHasPermission('can_access_delete')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->sliderRepository->deleteSlider($id);

        return redirect('admin/slider')->with('flash_message', 'Slider deleted!');
    }

    public function statusChange(Request $request)
    {
        $slider = $this->sliderRepository->sliderStatusChange($request);

        return response()->json([
            "success"   => true,
            'isPublish' => $slider->status,
            'id'        => $slider->id,
        ]);
    }
}
