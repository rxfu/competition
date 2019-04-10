<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class MenuComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $title = Arr::get(config('menu.sidebar'), request()->segment(1) . '.title');
        
        $view->with(compact('title'));
    }
}
