<?php

namespace App\Repositories;

use App\Entities\Group;

class GroupRepository extends Repository
{
    public function __construct(Group $group)
    {
        $this->object = $group;
    }
}
