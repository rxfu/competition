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
        $module = request()->segment(1);
        $sidebar = config('menu.sidebar');

        if (Arr::has($sidebar, $module . '.title')) {
            $title = Arr::get($sidebar, $module . '.title');
        } else {
            foreach ($sidebar as $item) {
                if (is_array($item) && array_key_exists('children', $item)) {
                    if (is_null($title = Arr::get($item['children'], $module . '.title'))) {
                        continue;
                    } else {
                        break;
                    }
                }
            }
        }

        $view->with(compact('title'));
    }
}
