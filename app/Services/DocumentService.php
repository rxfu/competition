<?php

namespace App\Services;

use App\Exceptions\InternalException;
use App\Repositories\DocumentRepository;
use Illuminate\Database\QueryException;

class DocumentService extends Service
{
    public function __construct(DocumentRepository $documents)
    {
        $this->repository = $documents;
    }

    public function updateOrCreate($attributes, $data)
    {
        try {
            return $this->repository->getObject()->updateOrCreate($attributes, $data);
        } catch (QueryException $e) {
            throw new InternalException('上传文件更新失败', $this->repository->getObject(), 'update', $e);
        }
    }
}
