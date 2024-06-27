<?php

namespace App\Imports;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\ProductLabel;
use App\Models\ProductMeta;
use App\Models\ProductRating;
use App\Models\Promotion;
use App\Models\Region;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToCollection, WithHeadingRow, ShouldQueue, WithChunkReading
{
    use Importable;

    public $attribute_term;
    public $row_count = 0;

    public function __construct($attribute_term)
    {
        $this->attribute_term = $attribute_term;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            $product_label = ProductLabel::where('name_en', $row['product_label_en'])->first();

            if (!$product_label) {
                $product_label = ProductLabel::create([
                    'name_en'   => $row['product_label_en'],
                    'name_hant' => $row['product_label_hant'],
                    'name_hans' => $row['product_label_hans'],
                ]);
            }

            $country = Country::where('name_en', $row['country_name_en'])->first();
            $region  = Region::where('name_en', $row['region_name_en'])->first();

            if (!$country) {
                $country = Country::create([
                    'name_en'   => $row['country_name_en'],
                    'name_hant' => $row['country_name_hant'],
                    'name_hans' => $row['country_name_hans'],
                ]);
            }

            if (!$region) {
                $region = Region::create([
                    'country_id' => $country->id,
                    'name_en'    => $row['region_name_en'],
                    'name_hant'  => $row['region_name_hant'],
                    'name_hans'  => $row['region_name_hans'],
                ]);
            }

            $image_path = "storage/files/shares/Products/";

            $product = Product::where('code', $row['product_number'])->first();

            $offer_labels = [
                'en'   => $row['member_offer_label_en'] ?? '',
                'hant' => $row['member_offer_label_hant'] ?? '',
                'hans' => $row['member_offer_label_hans'] ?? '',
            ];

            $store_data = [
                'label_id'           => $product_label->id,
                'country_id'         => $country ? $country->id : null,
                'region_id'          => $region ? $region->id : null,
                'code'               => $row['product_number'],
                'name_en'            => $row['product_name_en'],
                'name_hant'          => $row['product_name_hant'],
                'name_hans'          => $row['product_name_hans'],
                'type'               => $row['type'],
                'offer_labels'       => $offer_labels,
                'capacity'           => $row['capacity'],
                'original_price'     => $row['original_price'],
                'special_offer'      => $row['sale_price'],
                'quantity'           => $row['quantity'],
                'sell_quantity'      => $row['sell_quantity'],
                'refill_quantity'    => $row['refill_quantity'] ?? 0,
                'min_stock_quantity' => $row['min_stock_quantity'] ?? 0,
                'feature_image'      => $image_path . $row['image'],
                'status'             => strtolower($row['is_publish']) == 'y' ? 1 : 0,
                'is_exclusive'       => strtolower($row['is_exclusive_product']) == 'y' ? 1 : 0,
                'sort'               => ++$key + (session('rowCount') ?? 0),
            ];

            if ($product) {
                $product->update($store_data);
            } else {
                $product = Product::create($store_data);
            }

            //for category

            $category = Category::where('name_en', $row['category_en'])->first();

            if (!$category) {
                $category = Category::create([
                    'name_en'   => $row['category_en'],
                    'name_hant' => $row['category_hant'],
                    'name_hans' => $row['category_hans'],
                ]);
            }
            $category_data[$category->id] = ['product_id' => $product->id];

            $product->categories()->sync($category_data);

            //for promotion

            $promotion_data = Promotion::where('name_en', $row['promotion_en'])->first();

            if (!$promotion_data) {
                $promotion_data = Promotion::create([
                    'name_en'   => $row['promotion_en'],
                    'name_hant' => $row['promotion_hant'],
                    'name_hans' => $row['promotion_hans'],
                ]);
            }

            $product->promotions()->sync($promotion_data);

            //for attributes

            $attribute_data = [];

            $attribute_vintage = Attribute::where('name', $row['vintage'])->first();
            // $vintage_term_id   = AttributeTerm::where('id', $attribute_vintage->attribute_term_id)->first();

            if (!$attribute_vintage) {
                $attribute_vintage = Attribute::create([
                    'attribute_term_id' => $this->attribute_term['Vintage'],
                    'name'              => $row['vintage'],
                    // 'name_hant'         => $row['vintage_hant'],
                    // 'name_hans'         => $row['vintage_hans'],
                ]);
            }

            // $attribute_vintage ? $attribute_data[$attribute_vintage->id] = ['attribute_term_id' => $vintage_term_id->attribute_term_id, 'product_id' => $product->id] : '';
            $attribute_vintage ? $attribute_data[$attribute_vintage->id] = ['attribute_term_id' => $this->attribute_term['Vintage'], 'product_id' => $product->id] : '';

            $attribute_bottle = Attribute::where('name', $row['bottle_size'])->first();
            // $bottle_term_id   = AttributeTerm::where('id', $attribute_bottle->attribute_term_id)->first();

            if (!$attribute_bottle) {
                $attribute_bottle = Attribute::create([
                    'attribute_term_id' => $this->attribute_term['Bottle Size'],
                    'name'              => $row['bottle_size'],
                    // 'name_hant' => $row['bottle_size_hant'],
                    // 'name_hans' => $row['bottle_size_hans'],
                ]);
            }

            // $attribute_bottle ? $attribute_data[$attribute_bottle->id] = ['attribute_term_id' => $bottle_term_id->id, 'product_id' => $product->id] : '';
            $attribute_bottle ? $attribute_data[$attribute_bottle->id] = ['attribute_term_id' => $this->attribute_term['Bottle Size'], 'product_id' => $product->id] : '';

            $attribute_package = Attribute::where('name', $row['package_size'])->first();
            // $package_term_id   = AttributeTerm::where('id', $attribute_package->attribute_term_id)->first();

            if (!$attribute_package) {
                $attribute_package = Attribute::create([
                    'attribute_term_id' => $this->attribute_term['Package Size'],
                    'name'              => $row['package_size'],
                    // 'name_hant' => $row['package_size_hant'],
                    // 'name_hans' => $row['package_size_hans'],
                ]);
            }

            // $attribute_package ? $attribute_data[$attribute_package->id] = ['attribute_term_id' => $package_term_id->attribute_term_id, 'product_id' => $product->id] : '';
            $attribute_package ? $attribute_data[$attribute_package->id] = ['attribute_term_id' => $this->attribute_term['Package Size'], 'product_id' => $product->id] : '';

            $product->attributes()->sync($attribute_data);

            //For Product Meta

            $product_meta = ProductMeta::where('product_id', $product->id)->first();

            $contents = [
                'en'   => $row['content_en'],
                'hant' => $row['content_hant'],
                'hans' => $row['content_hans'],
            ];

            $descriptions = [
                'en'   => $row['description_en'],
                'hant' => $row['description_hant'],
                'hans' => $row['description_hans'],
            ];

            $testing_notes = [
                'en'   => $row['testing_note_en'],
                'hant' => $row['testing_note_hant'],
                'hans' => $row['testing_note_hans'],
            ];

            $product_details = [
                'en'   => $row['product_detail_en'],
                'hant' => $row['product_detail_hant'],
                'hans' => $row['product_detail_hans'],
            ];

            $awards = [
                'en'   => $row['award_en'],
                'hant' => $row['award_hant'],
                'hans' => $row['award_hans'],
            ];

            $meta_data = [
                'product_id'      => $product->id,
                'contents'        => $contents,
                'descriptions'    => $descriptions,
                'testing_notes'   => $testing_notes,
                'product_details' => $product_details,
                'awards'          => $awards,
            ];

            if ($product_meta) {
                $product_meta->update($meta_data);
            } else {
                $product_meta = ProductMeta::create($meta_data);
            }

            //For Product Rating

            $product_rating = ProductRating::where('product_id', $product->id)->first();

            $rating_data = [
                'product_id' => $product->id,
                'score_rp'   => $row['rating_rp'] ? $row['rating_rp'] : null,
                'score_ws'   => $row['rating_ws'] ? $row['rating_ws'] : null,
                'score_jh'   => $row['rating_jh'] ? $row['rating_jh'] : null,
                'score_bc'   => $row['rating_bc'] ? $row['rating_bc'] : null,
                'score_js'   => $row['rating_js'] ? $row['rating_js'] : null,
                'score_bh'   => $row['rating_bh'] ? $row['rating_bh'] : null,
            ];

            if ($product_rating) {
                $product_rating->update($rating_data);
            } else {
                $prodduct_rating = ProductRating::create($rating_data);
            }
        }

        $this->row_count = session('rowCount') + 500;

        session()->put('rowCount', $this->row_count);

        // \Log::info('product import row count ='. session('rowCount'));
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
