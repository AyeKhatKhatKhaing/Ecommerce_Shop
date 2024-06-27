<?php

namespace App\Listeners;

use App\Events\ViewedProduct;
use App\Models\RecentView;
use Carbon\Carbon;

class CreatedRecentViewProduct
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ViewedProduct  $event
     * @return void
     */
    public function handle(ViewedProduct $event)
    {
        $member  = $event->member;
        $product = $event->product;

        if ($member->recents) {
            /* delete old recents product over 15 mins */
            $member->recents->map(function ($recent) {
                $add_time = Carbon::parse($recent->viewed_at)->addMinutes(15)->format('Y-m-d H:i:s');
                if ($add_time < now()) {
                    $recent->delete();
                }
            });
        }

        $recent_view = RecentView::where(['member_id' => $member->id, 'product_id' => $product->id])->first();

        $recent_data = [
            'product_id' => $product->id,
            'type'       => $product->type,
            'viewed_at'  => now(),
        ];

        if ($recent_view) {
            $recent_view->update($recent_data);
        } else {
            $member->recents()->create($recent_data);
        }

    }
}
