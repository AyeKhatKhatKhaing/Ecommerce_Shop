<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class StockRefillCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:stock-refill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is the stock refill function if have stock refill quantity while out of stock.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $product_ids = collect();

        Product::where('refill_quantity', '>', 0)
            ->where('product_status', false)
            ->whereNotNull('refill_quantity')
            ->chunkById(500, function (Collection $items) use($product_ids) {
                $items->map(function ($item) use($product_ids) {
                    $refill_quantity = $item->sell_quantity + $item->refill_quantity;
                    $sell_quantity   = ($refill_quantity >= $item->quantity) ? $item->quantity : $refill_quantity;

                    $item->update(['sell_quantity' => $sell_quantity, 'product_status' => true]);
                    $product_ids->push($item->id);
                });
            });

        if($product_ids->count() > 0) {
            $product_ids = $product_ids->unique()->values()->all();
            \Log::info('Stock refill command generated.', $product_ids);
        }

        return Command::SUCCESS;
    }
}
