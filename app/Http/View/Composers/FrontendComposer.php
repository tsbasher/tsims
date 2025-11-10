<?php

namespace App\Http\View\Composers;

use App\Models\ProductGroup;
use App\Models\WebsiteSetting;
use Illuminate\View\View;

class FrontendComposer
{
    public function compose(View $view): void
    {
        $groups= ProductGroup::where('is_active',1)->with('categories')->get();
        $menu_groups= ProductGroup::where('show_as_featured','1')->where('is_active',1)->with('categories')->get();
        $setting=WebsiteSetting::first();
        $view->with('setting',$setting);
        $view->with('groups',$groups);
        $view->with('menu_groups',$menu_groups);
    }
}
