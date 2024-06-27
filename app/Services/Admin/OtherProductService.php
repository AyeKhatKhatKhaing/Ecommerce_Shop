<?php

namespace App\Services\Admin;

use App\Helpers\DataArrayHelper;
use App\Helpers\AdminHelper;
use App\Models\Category;
use App\Models\Classification;
use App\Models\Country;
use App\Models\OfferPromotion;
use App\Models\Product;
use App\Models\ProductLabel;
use App\Models\ProductMeta;
use App\Models\ProductRating;
use App\Models\Region;
use DB;
use Str;

class OtherProductService
{
    public function getFormData($type = null)
    {
        return [
            'attribute_terms'  => DataArrayHelper::getAttributes(),
            'categories'       => self::getCategories(),
            'classifications'  => Classification::where('status', true)->whereNull('deleted_at')->get(['id', 'name_en']),
            'countries'        => Country::with('regions')->where('status', true)->whereNull('deleted_at')->get(['id', 'name_en']),
            'regions'          => Region::where('status', true)->whereNull('deleted_at')->get(['id', 'name_en']),
            'offer_promotions' => OfferPromotion::where('status', true)->whereNull('deleted_at')->get(['id', 'name_en']),
            'product_labels'   => ProductLabel::where('status', true)->whereNull('deleted_at')->get(['id', 'name_en']),
            'promotions'       => DataArrayHelper::getPromotionArray(),
            'recommendations'  => self::getRecomProducts(),
        ];
    }

    public function getRecomProducts()
    {
        $products = DB::table('products')->select('id', DB::raw('CONCAT(name_en,"(", code, ")") AS product_code'))->where('is_other', true)->whereNull('deleted_at')->orderBy('name_en', 'asc')->pluck('product_code', 'id')->toArray();

        return $products;
    }

    public function getCategories()
    {
        $categories = Category::with(['subcategories' => function ($q) {
            $q->select('id', 'parent_id', 'name_en');
        }])->select('id', 'name_en')->where('is_other', true)->whereNull('parent_id')->active()->withCount('subcategories')->get();

        return $categories;
    }

    public function storeProductData($request, $other_product = null)
    {
        $offer_sale_price          = 0;
        
        if ($request->offer_promotion_id) {
            $offer_promotion       = OfferPromotion::active()->find($request->offer_promotion_id);
            
            if ($offer_promotion->is_percent) {
                $percent           = $request->original_price * ($offer_promotion->percent / 100);
                $offer_sale_price  = $request->original_price - $percent;
            } else {
                $offer_sale_price  = $request->original_price - $offer_promotion->amount;
            }
        }

        $request_data = [
            'label_id'           => $request->label_id,
            'offer_promotion_id' => $request->offer_promotion_id,
            'country_id'         => $request->country_id ? $request->country_id : null,
            'region_id'          => $request->region_id ? $request->region_id : null,
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
            'min_stock_quantity' => $request->min_stock_quantity,
            'recommendations'    => $request->recommendations,
            'weight'             => $request->weight,
            'length'             => $request->length,
            'width'              => $request->width,
            'height'             => $request->height,
            'feature_image'      => AdminHelper::storageFileExist($request->feature_image),
            'feature_image_alt'  => $request->feature_image_alt,
            'capacity'           => $request->capacity,
            'is_promotion'       => $request->offer_promotion_id ? 1 : 0,
            'is_cross_sell'      => $request->is_cross_sell == 'on' ? 1 : 0,
            'is_exclusive'       => $request->is_exclusive == 'on' ? 1 : 0,
            'is_other'           => $request->is_other == 'on' ? 1 : 0,
            'sort'               => $request->sort ? $request->sort : null,
            'created_date'       => now(),
            'created_by'         => auth()->user()->id,
            'updated_by'         => auth()->user()->id,
        ];

        // if (!$request_data['sale_price']) {
            $offer_labels   =  [
                'en'    => $request->offer_label_en,
                'hant'  => $request->offer_label_hant,
                'hans'  => $request->offer_label_hans,
            ];

            $request_data['offer_labels'] = $offer_labels;
        // }

        if ($other_product) {
            $request_data['product_status'] = ($request->min_stock_quantity == $request->sell_quantity || $request->sell_quantity == 0) ? 0 : 1;
            $other_product->update($request_data);
        } else {
            $other_product = Product::create($request_data);
        }

        return $other_product;
    }

    public function storeProductRelatedData($request, $other_product)
    {
        $this->storeProductMetas($request, $other_product);
        $this->storeProductRating($request, $other_product);
        $this->storeAttributesData($request, $other_product);
        $this->storePivotData($request, $other_product);
    }

    public function storeProductRating($request, $other_product)
    {
        $product_rating_data = [
            'product_id'       => $other_product->id,
            'score_rp'         => !empty($request->score_rp) ? $request->score_rp : null,
            'score_ws'         => !empty($request->score_ws) ? $request->score_ws : null,
            'score_jh'         => !empty($request->score_jh) ? $request->score_jh : null,
            'score_bc'         => !empty($request->score_bc) ? $request->score_bc : null,
            'score_js'         => !empty($request->score_js) ? $request->score_js : null,
            'score_bh'         => !empty($request->score_bh) ? $request->score_bh : null,
        ];

        $product_rating = isset($other_product->product_rating) ? $other_product->product_rating : null;

        if ($product_rating) {
            $product_rating->update($product_rating_data);
        } else {
            $product_rating = ProductRating::create($product_rating_data);
        }
    }

    public function storeProductMetas($request, $other_product)
    {
        $contents     = [
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
            'product_id'           => $other_product->id,
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

        $product_metas = isset($other_product->product_meta) ? $other_product->product_meta : null;

        if ($product_metas) {
            $product_metas->update($storeData);
        } else {
            $product_metas = ProductMeta::create($storeData);
        }
    }

    public function storeAttributesData($request, $other_product)
    {
        $attribute_values = $request->simple_attribute_values ? $request->simple_attribute_values : [];
        $attribute_names  = $request->simple_attribute_names ? $request->simple_attribute_names : [];

        if (count($attribute_values) != count($attribute_names))
            return false;

        $data = [];
        foreach ($attribute_values as $key => $val) {
            $data[$val] = ['attribute_term_id' => $attribute_names[$key], 'product_id' => $other_product->id];
        }

        $other_product->attributes()->sync($data);
    }

    public function storePivotData($request, $other_product)
    {
        $product_promotions      = $request->promotions;
        $product_classifications = $request->classifications;

        $data               = [];
        if (isset($request->categories)) {
            $categories     = $request->categories;
            $category_ids   = Category::whereIn('id', $categories)->pluck('parent_id', 'id')->toArray();
            foreach ($category_ids as $key => $val) {
                $data[$key] = ['product_id' => $other_product->id];
            }
            $other_product->categories()->sync($data);
        } else {
            $other_product->categories()->sync($data);
        }

        if (isset($product_promotions)) {
            $other_product->promotions()->sync($product_promotions);
        }

        if (isset($product_classifications)) {
            $other_product->classifications()->sync($product_classifications);
        }
    }

    public function getProductAttributeForm($request)
    {
        $row             = $request->attribute_row;
        $class           = $request->class_name;

        $attribute_name  = $class . "_attribute_names[]";
        $attribute_value = $class . "_attribute_values[]";

        $html  = '';
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
}
