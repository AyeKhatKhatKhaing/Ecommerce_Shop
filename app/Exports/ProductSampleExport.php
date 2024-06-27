<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;

class ProductSampleExport implements WithHeadings, FromArray, ShouldAutoSize, WithStyles 
{
    public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return [
            'Product Number',
            'Product Name Hant',
            'Product Name Hans',
            'Product Name En',
            'Type',
            'Original Price',
            'Sale Price',
            'Quantity',
            'Sell Quantity',
            'Refill Quantity',
            'Min Stock Quantity',
            'Capacity',
            'Product Label Hant',
            'Product Label Hans',
            'Product Label En',
            'Member Offer Label Hant',
            'Member Offer Label Hans',
            'Member Offer Label En',
            'Country Name Hant',
            'Country Name Hans',
            'Country Name En',
            'Region Name Hant',
            'Region Name Hans',
            'Region Name En',
            'Category Hant',
            'Category Hans',
            'Category En',
            'Promotion Hant',
            'Promotion Hans',
            'Promotion En',
            'Classification Hant',
            'Classification Hans',
            'Classification En',
            'Vintage',
            'Bottle Size',
            'Package Size',
            'Content Hant',
            'Content Hans',
            'Content En',
            'Rating RP',
            'Rating WS',
            'Rating JR',
            'Rating JS',
            'Rating JA',
            'Rating JH',
            'Description Hant',
            'Description Hans',
            'Description En',
            'Testing Note Hant',
            'Testing Note Hans',
            'Testing Note En',
            'Product Detail Hant',
            'Product Detail Hans',
            'Product Detail En',
            'Award Hant',
            'Award Hans',
            'Award En',
            'Image',
            'Is Publish',
            'Is Exclusive Product'
        ];
    }

    public function array(): array
    {
        return [

        ];
    }
}
