<?php

namespace App\Console\Commands;

use App\Models\OrderItem;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class UpdateProductQuantityCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:update-product-quantity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is the update product quantity function when payment status is zero within one hour.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $product_ids = collect();

        $orders = DB::table('orders')->where('is_trashed', 0)->where('payment_status', 0)->where('created_date', '<', Carbon::now()->subHour())->pluck('id', 'id');

        OrderItem::with('product')->whereIn('order_id', $orders)
            ->chunkById(500, function (Collection $items) use($product_ids) {
                $items->map(function ($item) use($product_ids) {
                    $item->product->update([
                        'quantity'         => $item->product->quantity + $item->quantity,
                        'sell_quantity'    => $item->product->sell_quantity + $item->quantity,
                        'ordered_quantity' => $item->product->ordered_quantity - $item->quantity,
                        'ordered_count'    => $item->product->ordered_count - 1,
                        'product_status'   => 1,
                    ]);
                    $item->order->update(['is_trashed' => 1]);
                    $product_ids->push($item->id);
                });
            });

        if($product_ids->count() > 0) {
            \Log::info('Update product quantity command generated, order ids ', $orders->toArray());
        }

        return Command::SUCCESS;
    }
}
