<?php

namespace App\Models;

use App\Traits\ActionUser;
use App\Traits\Active;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Str;

class Product extends Model
{
    use LogsActivity;
    use SoftDeletes;
    use ActionUser, Active;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['offer_promotion_id', 'country_id', 'region_id', 'label_id', 'code', 'type', 'name_en', 'name_hant', 'name_hans', 'slug', 'sku', 'currency_type', 'original_price', 'sale_price', 'quantity', 'sell_quantity', 'refill_quantity', 'min_stock_quantity', 'offer_labels', 'recommendations', 'weight', 'length', 'width', 'height', 'feature_image', 'feature_image_alt', 'ordered_quantity', 'ordered_count', 'year', 'capacity', 'is_cross_sell', 'is_exclusive', 'is_promotion', 'sort', 'status', 'product_status', 'is_other', 'expired_at', 'created_date', 'created_by', 'updated_by'];

    protected $casts = [
        'recommendations' => 'array',
        'offer_labels'    => 'array',
    ];

    public function scopeExclusive($query)
    {
        return $query->where('is_exclusive', true);
    }

    public function scopeHotProduct($query)
    {
        return $query->where('ordered_count', '>', 0)
            ->whereNotNull('ordered_count')
            ->orderBy('ordered_count', 'desc');
    }

    public function scopeSortBestSell($query)
    {
        return $query->orderBy('ordered_count', 'desc');
    }

    public function scopePriceAsc($query)
    {
        return $query->orderBy('original_price', 'asc')->orderBy('sale_price', 'asc');
    }

    public function scopePriceDesc($query)
    {
        return $query->orderBy('original_price', 'desc')->orderBy('sale_price', 'desc');
    }

    public function scopeIsOther($query)
    {
        return $query->where('is_other', true);
    }

    public function scopeIsNotOther($query)
    {
        return $query->where('is_other', false);
    }

    public function scopeSort($query)
    {
        return $query->orderBy('sort', 'asc');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class);
    }

    public function offer_promotion()
    {
        return $this->belongsTo(OfferPromotion::class);
    }

    public function classifications()
    {
        return $this->belongsToMany(Classification::class);
    }

    public function product_meta()
    {
        return $this->hasOne(ProductMeta::class, 'product_id');
    }

    public function product_rating()
    {
        return $this->hasOne(ProductRating::class);
    }

    public function attribute_terms()
    {
        return $this->belongsToMany(AttributeTerm::class, 'attribute_product', 'product_id', 'attribute_term_id')->distinct();
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product', 'product_id', 'attribute_id')->withPivot(['product_id']);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function label()
    {
        return $this->belongsTo(ProductLabel::class, 'label_id');
    }

    public function product_label()
    {
        return $this->belongsTo(ProductLabel::class, 'label_id');
    }

    public function isSoldOut($product)
    {
        $status = false;

        if ($product) {
            if (($product->min_stock_quantity == $product->sell_quantity) || $product->sell_quantity == 0 || is_null($product->sell_quantity)) {
                $status = true;
            }
        }

        return $status;
    }

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */

    public function getCategoriesName($categories)
    {
        $data = $categories->pluck('name_en')->toArray();

        if (isset($data)) {
            return implode(", ", $data);
        } else {
            return "";
        }

    }

    public function getPromotionsName($promotions)
    {
        $data = $promotions->pluck('name_en')->toArray();

        if (isset($data)) {
            return implode(", ", $data);
        } else {
            return "";
        }

    }

    public function getClassificationsName($classifications)
    {
        $data = $classifications->pluck('name_en')->toArray();

        if (isset($data)) {
            return implode(", ", $data);
        } else {
            return "";
        }

    }

    public function getDescriptionLimit($product_meta)
    {
        if ($product_meta && isset($product_meta->descriptions[lngKey()])) {
            $description = strip_tags($product_meta->descriptions[lngKey()]);
            switch (lngKey()) {
                case 'en':
                    $resp_description = Str::limit($description, 74, '...');
                    break;
                case 'hant':
                    $resp_description = Str::limit($description, 74, '...');
                    break;
                case 'hans':
                    $resp_description = Str::limit($description, 74, '...');
                    break;
            }
        }

        return $resp_description ?? '';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'offer_promotion_id', 'code', 'type', 'name_en', 'name_hant', 'name_hans', 'slug', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Product model has been $eventName";
            });
    }
}
