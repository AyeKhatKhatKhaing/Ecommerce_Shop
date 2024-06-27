<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class OrderExport implements FromView, ShouldAutoSize, WithEvents
{
    use RegistersEventListeners;

    protected $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function view(): View
    {
        return view('admin.excel.order_export', [
            'orders' => $this->orders,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color'       => ['argb' => '000000'],
                        ],
                    ],
                ];

                $bottomBorder = [
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color'       => ['argb' => '000000'],
                        ],
                    ],
                ];

                $topBorder = [
                    'borders' => [
                        'top' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color'       => ['argb' => '000000'],
                        ],
                    ],
                ];

                $event->sheet->getStyle('E' . $event->sheet->getHighestRow() . ':' . $event->sheet->getHighestColumn() . $event->sheet->getHighestRow())->applyFromArray($styleArray);
                $event->sheet->getStyle('A' . $event->sheet->getHighestRow() . ':' . $event->sheet->getHighestColumn() . $event->sheet->getHighestRow())->applyFromArray($topBorder);

                $orders       = $this->orders;
                $first_record = 0; /* for other cell looping */

                foreach ($orders as $key => $order) {
                    if ($key == 0) {
                        $rows = count($order->order_items) + 4;
                        $first_record += count($order->order_items) + 4;
                    }

                    if ($key != 0) {
                        $second_rows = count($order->order_items);
                        $first_record += $second_rows + 1;
                        $rows = $first_record;
                    }

                    $cellRange = 'A' . $rows . ':H' . $rows;
                    $event->sheet->getDelegate()->getStyle('A3:H3')->applyFromArray($bottomBorder);
                    $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($bottomBorder);
                }
            },
        ];
    }
}
