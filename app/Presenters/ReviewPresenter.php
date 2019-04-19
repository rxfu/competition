<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class ReviewPresenter extends Presenter
{
    public function total()
    {
        return $this->design_score * 0.2 + $this->live_score * 0.8;
    }
}
