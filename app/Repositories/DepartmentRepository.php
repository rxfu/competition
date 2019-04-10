<?php

namespace App\Repositories;

use App\Entities\Department;

class DepartmentRepository extends Repository
{
    public function __construct(Department $department)
    {
        $this->object = $department;
    }

    public function getEnabled($enable = true)
    {
        try {
            return $this->object->whereIsEnable($enable)->get();
        } catch (QueryException $e) {
            throw new InternalException($this->getModel() . ' 对象查询失败', $this->getObject(), 'query', $e);
        }
    }
}
