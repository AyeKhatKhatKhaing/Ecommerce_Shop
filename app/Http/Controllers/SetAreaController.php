<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;

class SetAreaController extends Controller
{
    public function __invoke(Request $request, $area)
    {
        if(in_array($area, config('locale.areas'))) {
            session()->put('area', $area);
        }

        if($request->ajax()) {
            return response()->json(['status' => 'success'], 200);
        }

        if (Str::contains(url()->previous(), ['/product/', '/checkout'])) {
            return redirect()->route('front.home')->with('location-warning-popup', 'Click UnderStand');
        }

        return redirect()->back()->with('location-warning-popup', 'Click UnderStand');
    }
}
