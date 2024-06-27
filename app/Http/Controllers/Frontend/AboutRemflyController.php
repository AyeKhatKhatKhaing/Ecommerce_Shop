<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutRemfly;

class AboutRemflyController extends Controller
{
    public function aboutRemfly()
    {
        $aboutremfly = AboutRemfly::first();

        return view('frontend.about-remfly.index', compact('aboutremfly'));
    }
}
