<?php

namespace App\Providers;

use App\Events\MemberLoggedIn;
use App\Events\ContactUsEvent;
use App\Events\ForgotPasswordEvent;
use App\Events\MemberRegistered;
use App\Events\NewsletterCreatedEvent;
use App\Events\OrderEmailCreatedEvent;
use App\Events\ViewedProduct;
use App\Listeners\AssignCoupon;
use App\Listeners\AssignMemberType;
use App\Listeners\UpdateCart;
use App\Listeners\ContactUsListener;
use App\Listeners\CreatedRecentViewProduct;
use App\Listeners\ForgotPasswordSendMailAndSMSListener;
use App\Listeners\ForgotPasswordSendMailListener;
use App\Listeners\ForgotPasswordSendSMSListener;
use App\Listeners\NewsletterCreatedListener;
use App\Listeners\OrderEmailCreatedListener;
use App\Listeners\SendRegisterMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        ContactUsEvent::class => [
            ContactUsListener::class
        ],
        NewsletterCreatedEvent::class => [
            NewsletterCreatedListener::class
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        MemberRegistered::class => [
            SendRegisterMail::class,
            AssignMemberType::class,
            AssignCoupon::class,
        ],
        MemberLoggedIn::class => [
            UpdateCart::class,
        ],
        ViewedProduct::class => [
            CreatedRecentViewProduct::class
        ],
        ForgotPasswordEvent::class => [
            ForgotPasswordSendMailAndSMSListener::class,
        ],
        OrderEmailCreatedEvent::class => [
            OrderEmailCreatedListener::class
        ]
        
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
