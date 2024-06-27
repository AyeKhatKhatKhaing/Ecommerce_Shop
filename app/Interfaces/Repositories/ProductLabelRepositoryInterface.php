<?php

namespace App\Interfaces\Repositories;

interface ProductLabelRepositoryInterface
{
    /**
     * get the product label list
     * @param $request
     * @return $data[]
     */
    public function getAllProductLabelList($request);

    /**
     * get the request data
     * @param $request, $id
     * @return $product_label
     */
    public function saveProductLabelData($request, $id);

    /**
     * get the product label by id
     * @param $id
     * @return $productlabel
     */
    public function getProductLabelData($id);

    /**
     * get the product label by id
     * @param $id
     * @return $productlabel
     */
    public function deleteProductLabel($id);

    /**
     * get the product label by request id
     * @param $request
     * @return $productlabel
     */
    public function productLabelStatusChange($request);
}
