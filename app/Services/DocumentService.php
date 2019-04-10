<?php

namespace App\Services;

use App\Repositories\DocumentRepository;

class DocumentService extends Service
{
    public function __construct(DocumentRepository $documents)
    {
        $this->repository = $documents;
    }
}
