<?php

namespace App\View\Components\Frontend;

use App\Helpers\FrontendHelper;
use Illuminate\View\Component;

class MenuHeader extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $header_menus = null;
    public $isAuth = null;
    public $authMember = null;


    public function __construct($isAuth, $authMember)
    {
        $this->isAuth = $isAuth;
        $this->authMember = $authMember;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->header_menus = FrontendHelper::getMenus();
        // dd($this->header_menus, $this->isAuth, $this->authMember);
        return view('components.frontend.menu-header');
    }
}
