<?php

namespace App\Services\Admin;

use App\Models\Attribute;
use App\Models\AttributeTerm;

class ProductAttributeService
{
    public function addAttributeTerm($request)
    {
        $request->merge(['created_date' => now(), 'created_by' => auth()->id()]);

        $requestData = $request->only(['name_en', 'name_hant', 'name_hans']);

        $attribute_term = AttributeTerm::create($requestData);

        return $attribute_term;
    }

    public function addAttributeValue($attribute_term, $request)
    {
        if (count($request->values) > 0) {
            foreach ($request->values as $key => $value) {
                Attribute::create([
                    'attribute_term_id' => $attribute_term->id,
                    'name'              => $value,
                    'slug'              => $request->slug,
                ]);
            }
        }
    }

    public function updateAttributeValue($term, $request)
    {
        $term->update([
            'name_en'    => $request->name_en,
            'name_hans'  => $request->name_hans,
            'name_hant'  => $request->name_hant,
            'updated_by' => auth()->user()->id,
            'status'     => $term->status,
        ]);

        $attr_ids = $term->attributes->pluck('id', 'id')->toArray();

        foreach ($request->values as $key => $value) {
            if (in_array($key, $attr_ids)) {
                Attribute::find($key)->update(['name' => $value]);
            } else {
                $term->attributes()->create([
                    'name' => $value,
                ]);
            }
        }

    }

}
