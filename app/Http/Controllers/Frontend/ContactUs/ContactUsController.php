<?php

namespace App\Http\Controllers\Frontend\ContactUs;

use App\Events\ContactUsEvent;
use App\Http\Controllers\Controller;
use App\Listeners\ContactUsListener;
use App\Notifications\ContactUsNotification;
use App\Http\Requests\Frontend\ContactFormRequest;
use App\Models\ContactAddress;
use App\Models\ContactForm;
use App\Models\ContactPage;

class ContactUsController extends Controller
{
    public function contactPage()
    {
        $contact_page      = ContactPage::first();
        $contact_addresses = ContactAddress::active()->select('id', 'name_en', 'name_hant', 'name_hans', 'address_en', 'address_hant', 'address_hans', 'google_map')->get();

        return view('frontend.contact_us.index', compact('contact_addresses', 'contact_page'));
    }

    public function storeContactData(ContactFormRequest $request)
    {
        $requestData                   = $request->only('name', 'email', 'phone_no', 'message', 'read_statement', 'receive_news');
        $requestData['read_statement'] = $request->read_statement ? 1 : 0;
        $requestData['receive_news']   = $request->receive_news ? 1 : 0;
        $requestData['created_date']   = now();
        // $requestData['created_by']     = auth()->user()->id;

        $contact_form = ContactForm::create($requestData);
        ContactUsEvent::dispatch($contact_form);

        return redirect()->back()->with('contact_success', 'Contact Form submit successfully');

    }
}
