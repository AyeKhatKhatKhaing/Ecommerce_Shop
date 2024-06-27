<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class MemberExport implements FromView,ShouldAutoSize
{
    protected $members;
    public function __construct($members)
    {
        $this->members = $members;
    }

    public function view(): View 
    {
		return view('admin.excel.member_export', [
            'members' => $this->members
        ]);
	}
}
