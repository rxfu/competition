<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class ReviewPresenter extends Presenter
{
    public function total()
    {
        return $this->design_score + $this->live_score;
    }
}
