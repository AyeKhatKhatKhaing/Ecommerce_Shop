<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ProductReportExport implements FromView,ShouldAutoSize
{
    protected $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function view(): View 
    {
		return view('admin.excel.product_report_export', [
            'products' => $this->products
        ]);
	}
}