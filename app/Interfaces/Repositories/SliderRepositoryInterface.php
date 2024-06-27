<?php

namespace App\Interfaces\Repositories;

interface SliderRepositoryInterface
{
    /**
     * get the slider list
     * @param $request
     * @return $data[]
     */
    public function getAllSliderList($request);

    /**
     * get the request data
     * @param $request, $id
     * @return $slider
     */
    public function saveSliderData($request, $id);

    /**
     * get the slider by id
     * @param $id
     * @return $slider
     */
    public function getSliderData($id);

    /**
     * get the slider by id
     * @param $id
     * @return $slider
     */
    public function deleteSlider($id);

    /**
     * get the slider by request id
     * @param $request
     * @return $slider
     */
    public function sliderStatusChange($request);
}
