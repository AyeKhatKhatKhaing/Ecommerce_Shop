<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TermCondition;

class TermConditionController extends Controller
{
    public function termCondition()
    {
        $termcondition = TermCondition::first();

        return view('frontend.term-condition.index', compact('termcondition'));
    }
}
