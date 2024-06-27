<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CommonProblem;

class CommonProblemController extends Controller
{
    public function commonProblem()
    {
        $commonproblem = CommonProblem::first();

        return view('frontend.common-problem.index', compact('commonproblem'));
    }
}
