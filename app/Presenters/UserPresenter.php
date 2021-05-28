<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
    public function isEnable()
    {
        return $this->is_enable ? '是' : '否';
    }

    public function isSuper()
    {
        return $this->is_super ? '是' : '否';
    }

    public function isPassed()
    {
        return $this->is_passed ? '已通过' : '未审核';
    }

    public function isFamous()
    {
        return $this->is_famous ? '是' : '否';
    }
}
