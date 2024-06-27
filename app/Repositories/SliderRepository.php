<?php

namespace App\Repositories;

use App\Interfaces\Repositories\SliderRepositoryInterface;
use App\Models\Slider;

class SliderRepository implements SliderRepositoryInterface
{
    public function getAllSliderList($request)
    {
        $keyword = $request->get('search');
        $perPage = $request->display ? $request->display : 10;
        $status  = $request->status == null ? "all" : $request->status;

        $slider = Slider::with('updateUser')->where(function ($query) use ($keyword, $status) {
            if ($keyword != null) {
                $query->where('names', 'LIKE', "%$keyword%");
            }

            if ($status != "all") {
                $query->where('status', $status);
            }
        });

        $slider = $slider->latest('id')->paginate($perPage);

        $data = [
            'keyword' => $keyword,
            'perPage' => $perPage,
            'status'  => $status,
            'slider'  => $slider,
        ];

        return $data;
    }

    public function saveSliderData($request, $id = null)
    {
        $requestData = $request->all();

        $names = [
            'en'   => $requestData['name_en'],
            'hant' => $requestData['name_hant'],
            'hans' => $requestData['name_hans'],
        ];

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

        $requestData['names']        = $names;
        $requestData['titles']       = $titles;
        $requestData['descriptions'] = $descriptions;

        if ($id) {
            $requestData['updated_by'] = auth()->user()->id;
            $slider                    = Slider::findOrFail($id);
            $slider->update($requestData);
        } else {
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;
            $slider                      = Slider::create($requestData);
        }

        return $slider;
    }

    public function getSliderData($id)
    {
        return Slider::findOrFail($id);
    }

    public function deleteSlider($id)
    {
        return Slider::destroy($id);
    }

    public function sliderStatusChange($request)
    {
        $slider = Slider::findOrFail($request->id);
        $slider->update(['status' => !$slider->status]);

        return $slider;
    }
}
