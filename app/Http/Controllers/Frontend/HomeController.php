<?php

namespace App\Http\Controllers\Frontend;

use App\Events\NewsletterCreatedEvent;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Traits\FrontPageTrait;
use Illuminate\Http\Request;
use Newsletter;

class HomeController extends Controller
{
    use FrontPageTrait;

    public function index()
    {
        $data = $this->getHomePageData();

        return view('frontend.home.index', $data); /* use for frontend home page */
    }

    public function subscribeNewsletter(Request $request)
    {
        $email   = $request->email;
        $message = '';

        $subscription = Subscription::where('email', $email)->first();

        if ($subscription) {
            if (auth()->guard('member')) {
                $subscription->update(['member_id' => auth()->guard('member')->Id()]);
            }
        } else {
            $subscription = Subscription::create([
                'member_id'    => auth()->guard('member')->Id(),
                'email'        => $email,
                'created_date' => now(),
            ]);
        }

        if (!Newsletter::isSubscribed($email)) {
            Newsletter::subscribe($email);
            NewsletterCreatedEvent::dispatch($subscription);
            $message .= "<p class='montserrat rem-text-16 text-[#1AAD19] px-5 pt-1'>Subscribe successfully</p>";
        } else {
            $message .= "<p class='montserrat rem-text-16 text-remred px-5 pt-1'>You have already subscribed.</p>";
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
        } else {
            return redirect()->back()->with('flash_message', 'Subscribed successfully');
        }
        
    }
}
