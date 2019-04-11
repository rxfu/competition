<?php

namespace App\Services;

use App\Exceptions\InvalidRequestException;
use App\Repositories\Repository;
use Illuminate\Database\QueryException;

class Service
{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function get($id)
    {
        return $this->repository->get($id);
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function store($data)
    {
        return $this->repository->store($data);
    }

    public function update($id, $data)
    {
        $this->repository->update($id, $data);
    }

    public function delete($ids)
    {
        $this->repository->deleteAll($ids);
    }
}
