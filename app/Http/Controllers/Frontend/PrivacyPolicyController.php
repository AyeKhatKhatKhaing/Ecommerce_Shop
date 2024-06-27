<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;

class PrivacyPolicyController extends Controller
{
    public function privacyPolicy()
    {
        $privacypolicy = PrivacyPolicy::first();

        return view('frontend.privacy-policy.index', compact('privacypolicy'));
    }
}
