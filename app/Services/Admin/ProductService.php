<?php

namespace App\Services\Admin;

use App\Helpers\AdminHelper;
use App\Helpers\DataArrayHelper;
use App\Models\Category;
use App\Models\Classification;
use App\Models\Country;
use App\Models\OfferPromotion;
use App\Models\Product;
use App\Models\ProductLabel;
use App\Models\ProductMeta;
use App\Models\ProductRating;
use App\Models\Region;
use Str;

class ProductService
{
    public function getFormData($type = null)
    {
        return [
            'attribute_terms'  => DataArrayHelper::getAttributes(),
            'categories'       => DataArrayHelper::getParentCategory(),
            'classifications'  => Classification::where('status', true)->whereNull('deleted_at')->get(['id', 'name_en']),
            'countries'        => Country::with('regions')->where('status', true)->whereNull('deleted_at')->get(['id', 'name_en']),
            'regions'          => Region::where('status', true)->whereNull('deleted_at')->get(['id', 'name_en']),
            'offer_promotions' => OfferPromotion::where('status', true)->whereNull('deleted_at')->get(['id', 'name_en']),
            'product_labels'   => ProductLabel::where('status', true)->whereNull('deleted_at')->get(['id', 'name_en']),
            'promotions'       => DataArrayHelper::getPromotionArray(),
            'recommendations'  => DataArrayHelper::getProductCodeArray($type),
        ];
    }

    public function storeProductData($request, $product = null)
    {
        $offer_sale_price = 0;

        if ($request->offer_promotion_id) {
            $offer_promotion = OfferPromotion::active()->find($request->offer_promotion_id);

            if ($offer_promotion->is_percent) {
                $percent          = $request->original_price * ($offer_promotion->percent / 100);
                $offer_sale_price = $request->original_price - $percent;
            } else {
                $offer_sale_price = $request->original_price - $offer_promotion->amount;
            }
        }

        $request_data = [
            'label_id'           => $request->label_id,
            'offer_promotion_id' => $request->offer_promotion_id,
            'country_id'         => $request->country_id,
            'region_id'          => $request->region_id,
            'code'               => $request->code,
            'type'               => $request->type,
            'name_en'            => $request->name_en,
            'name_hant'          => $request->name_hant,
            'name_hans'          => $request->name_hans,
            'slug'               => Str::slug($request->name_en),
            'sku'                => $request->sku,
            'currency_type'      => $request->currency_type,
            'original_price'     => $request->original_price,
            'sale_price'         => $offer_sale_price ? $offer_sale_price : $request->sale_price,
            'quantity'           => $request->quantity,
            'sell_quantity'      => $request->sell_quantity,
            'refill_quantity'    => $request->refill_quantity,
            'min_stock_quantity' => $request->min_stock_quantity ? $request->min_stock_quantity : 0,
            'recommendations'    => $request->recommendations,
            'weight'             => $request->weight,
            'length'             => $request->length,
            'width'              => $request->width,
            'height'             => $request->height,
            'feature_image'      => AdminHelper::storageFileExist($request->feature_image),
            'feature_image_alt'  => $request->feature_image_alt,
            'capacity'           => $request->capacity,
            'is_promotion'       => $request->offer_promotion_id ? 1 : 0,
            'sort'               => $request->sort,
            'is_cross_sell'      => $request->is_cross_sell == 'on' ? 1 : 0,
            'is_exclusive'       => $request->is_exclusive == 'on' ? 1 : 0,
            'created_date'       => now(),
            'created_by'         => auth()->user()->id,
            'updated_by'         => auth()->user()->id,
        ];

        // if (!$request_data['sale_price']) {
            $offer_labels = [
                'en'   => $request->offer_label_en,
                'hant' => $request->offer_label_hant,
                'hans' => $request->offer_label_hans,
            ];

            $request_data['offer_labels'] = $offer_labels;
        // }

        if ($product) {
            $request_data['product_status'] = ($request->min_stock_quantity == $request->sell_quantity || $request->sell_quantity == 0) ? 0 : 1;
            // dd($request_data);
            $product->update($request_data);
        } else {
            $product = Product::create($request_data);
        }

        return $product;
    }

    public function storeProductRelatedData($request, $product)
    {
        $this->storeProductMetas($request, $product);
        $this->storeProductRating($request, $product);
        $this->storeAttributesData($request, $product);
        $this->storePivotData($request, $product);
    }

    public function storeProductRating($request, $product)
    {
        $product_rating_data = [
            'product_id' => $product->id,
            'score_rp'   => !empty($request->score_rp) ? $request->score_rp : null,
            'score_ws'   => !empty($request->score_ws) ? $request->score_ws : null,
            'score_jh'   => !empty($request->score_jh) ? $request->score_jh : null,
            'score_bc'   => !empty($request->score_bc) ? $request->score_bc : null,
            'score_js'   => !empty($request->score_js) ? $request->score_js : null,
            'score_bh'   => !empty($request->score_bh) ? $request->score_bh : null,
        ];

        $product_rating = isset($product->product_rating) ? $product->product_rating : null;

        if ($product_rating) {
            $product_rating->update($product_rating_data);
        } else {
            $product_rating = ProductRating::create($product_rating_data);
        }

        // return true;
    }

    public function storeProductMetas($request, $product)
    {
        $contents = [
            'en'   => $request->content_en,
            'hant' => $request->content_hant,
            'hans' => $request->content_hans,
        ];

        $descriptions = [
            'en'   => $request->description_en,
            'hant' => $request->description_hant,
            'hans' => $request->description_hans,
        ];

        $testing_notes = [
            'en'   => $request->testing_note_en,
            'hant' => $request->testing_note_hans,
            'hans' => $request->testing_note_hant,
        ];

        $product_details = [
            'en'   => $request->product_detail_en,
            'hant' => $request->product_detail_hant,
            'hans' => $request->product_detail_hans,
        ];

        $awards = [
            'en'   => $request->award_en,
            'hant' => $request->award_hant,
            'hans' => $request->award_hans,
        ];

        $product_descriptions = [
            'en'   => $request->product_description_en,
            'hant' => $request->product_description_hant,
            'hans' => $request->product_description_hans,
        ];

        $meta_titles = [
            'en'   => $request->meta_title_en,
            'hant' => $request->meta_title_hant,
            'hans' => $request->meta_title_hans,
        ];

        $meta_descriptions = [
            'en'   => $request->meta_description_en,
            'hant' => $request->meta_description_hant,
            'hans' => $request->meta_description_hans,
        ];

        $storeData = [
            'product_id'           => $product->id,
            'contents'             => $contents,
            'descriptions'         => $descriptions,
            'testing_notes'        => $testing_notes,
            'product_details'      => $product_details,
            'awards'               => $awards,
            'product_descriptions' => $product_descriptions,
            'meta_titles'          => $meta_titles,
            'meta_descriptions'    => $meta_descriptions,
            'meta_image'           => AdminHelper::storageFileExist($request->meta_image),
            'meta_image_alt'       => $request->meta_image_alt,
        ];

        $product_metas = isset($product->product_meta) ? $product->product_meta : null;

        if ($product_metas) {
            // dd($product, $product_metas);
            $product_metas->update($storeData);
        } else {
            $product_metas = ProductMeta::create($storeData);
        }

        // return true;
    }

    public function storeAttributesData($request, $product)
    {
        $attribute_values = $request->simple_attribute_values ? $request->simple_attribute_values : [];
        $attribute_names  = $request->simple_attribute_names ? $request->simple_attribute_names : [];

        if (count($attribute_values) != count($attribute_names)) {
            return false;
        }

        $data = [];
        foreach ($attribute_values as $key => $val) {
            $data[$val] = ['attribute_term_id' => $attribute_names[$key], 'product_id' => $product->id];
        }

        $product->attributes()->sync($data);

        // return true;
    }

    public function storePivotData($request, $product)
    {
        $product_promotions      = $request->promotions;
        $product_classifications = $request->classifications;

        if (isset($request->categories)) {
            $data         = [];
            $categories   = $request->categories;
            $category_ids = Category::whereIn('id', $categories)->pluck('parent_id', 'id')->toArray();
            foreach ($category_ids as $key => $val) {
                $data[$key] = ['product_id' => $product->id];
            }
            $product->categories()->sync($data);
        }

        if (isset($product_promotions)) {
            $product->promotions()->sync($product_promotions);
        }

        if (isset($product_classifications)) {
            $product->classifications()->sync($product_classifications);
        }
    }

    public function getProductAttributeForm($request)
    {
        $row   = $request->attribute_row;
        $class = $request->class_name;

        $attribute_name  = $class . "_attribute_names[]";
        $attribute_value = $class . "_attribute_values[]";

        $html = '';
        $html .= '<div id="inputProductAttributeRow" class="row mt-4">';
        $html .= '<div class="col-md-5">';
        $html .= '<select id="' . $class . '-attribute-name-' . $row . '" valueRow="#' . $class . '-attribute-add-value-' . $row . '" name="' . $attribute_name . '" onchange="changeAttribute(this)" class="form-select product-attribute-name" data-control="select2" data-placeholder="Choose Attribute">';
        $html .= '<option></option>';
        $html .= '</select>';
        $html .= '</div>';
        $html .= '<div class="col-md-5">';
        $html .= '<select id="' . $class . '-attribute-add-value-' . $row . '" row="' . $row . '" name="' . $attribute_value . '" class="form-select product-attribute-value" data-control="select2" data-placeholder="Choose Value">';
        $html .= '</select>';
        $html .= '</div>';
        $html .= '<div class="col-md-2">';
        $html .= '<button type="button" id="deleteProductAttributeRow" class="btn-icon btn btn-danger w-100px"><i class="bi bi-trash-fill me-2"></i>Delete</button>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    public function importRules()
    {
        return [
            'product_number'      => 'required',
            'product_name_hant'   => 'required',
            'product_name_hans'   => 'required',
            'product_name_en'     => 'required',
            'type'                => 'required',
            'original_price'      => 'required|numeric',
            'sale_price'          => 'numeric',
            'quantity'            => 'required|numeric',
            'sell_quantity'       => 'numeric',
            'refill_quantity'     => 'numeric',
            'min_stock_quantity'  => 'numeric',
            'product_label_hant'  => 'required',
            'product_label_hans'  => 'required',
            'product_label_en'    => 'required',
            'category_hant'       => 'required',
            'category_hans'       => 'required',
            'category_en'         => 'required',
            'category_en'         => 'required|exists:categories,name_en',
            'promotion_hant'      => 'required',
            'promotion_hans'      => 'required',
            'promotion_en'        => 'required',
            'classification_hant' => 'required',
            'classification_hans' => 'required',
            'classification_en'   => 'required',
            'vintage'             => 'required',
            'bottle_size'         => 'required',
            'package_size'        => 'required',
            'content_hant'        => 'required',
            'content_hans'        => 'required',
            'content_en'          => 'required',
        ];
    }

    public function importValidationMessage($row)
    {
        return [
            'product_number.required'      => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.product_number_required'),
            'product_name_hant.required'   => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.product_name_hant_required'),
            'product_name_hans.required'   => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.product_name_hans_required'),
            'product_name_en.required'     => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.product_name_en_required'),
            'type.required'                => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.product_type_required'),
            'original_price.required'      => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.original_price_required'),
            'special_offer.required'       => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.special_offer_required'),
            'quantity.required'            => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.quantity_required'),
            'sell_quantity.required'       => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.sell_quantity_required'),
            'refill_quantity.required'     => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.refill_quantity_required'),
            'min_stock_quantity.required'  => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.min_stock_quantity_required'),
            'product_label_hant.required'  => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.product_label_hant_required'),
            'product_label_hans.required'  => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.product_label_hans_required'),
            'product_label_en.required'    => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.product_label_en_required'),
            'category_hant.required'       => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.category_hant_required'),
            'category_hans.required'       => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.category_hans_required'),
            'category_en.required'         => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.category_en_required'),
            'category_en.exists'           => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.category_en_exists'),
            'promotion_hant.required'      => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.promotion_hant_required'),
            'promotion_hans.required'      => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.promotion_hans_required'),
            'promotion_en.required'        => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.promotion_en_required'),
            'classification_hant.required' => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.classification_hant_required'),
            'classification_hans.required' => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.classification_hans_required'),
            'classification_en.required'   => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.classification_en_required'),
            'vintage.required'             => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.vintage_required'),
            'bottle_size.required'         => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.bottle_size_required'),
            'package_size.required'        => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.package_size_required'),
            'content_hant.required'        => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.content_hant_required'),
            'content_hans.required'        => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.content_hans_required'),
            'content_en.required'          => __('backend.import_validation_message.row_number_error') . ($row) . "." . __('backend.import_validation_message.content_en_required'),
        ];
    }
}
