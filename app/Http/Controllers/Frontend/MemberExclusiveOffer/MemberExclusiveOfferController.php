<?php

namespace App\Http\Controllers\Frontend\MemberExclusiveOffer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExclusiveOffer;
use App\Models\MemberExclusiveOffer;

class MemberExclusiveOfferController extends Controller
{
    public function memberExclusiveOffer()
    {
        $exclusive_offers  =  ExclusiveOffer::active()->select('id', 'titles', 'descriptions', 'image', 'image_alt', 'link')->orderBy('sort', 'asc')->take(3)->get();
        $exclusive_page    = MemberExclusiveOffer::first();
        
        return view('frontend.member_exclusive_offer.index', compact('exclusive_offers', 'exclusive_page'));
    }
}
