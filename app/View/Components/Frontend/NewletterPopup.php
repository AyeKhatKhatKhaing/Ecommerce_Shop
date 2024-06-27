<?php

namespace App\View\Components\Frontend;

use App\Models\SubscribeNotification;
use Illuminate\View\Component;

class NewletterPopup extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title       = null;
    public $description = null;
    public $url         = null;

    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $noti = SubscribeNotification::first();

        $this->url = url()->full();

        if ($noti) {
            $this->title       = $noti->titles[lngKey()];
            $this->description = $noti->descriptions[lngKey()];
        }

        return view('components.frontend.newletter-popup');
    }
}
