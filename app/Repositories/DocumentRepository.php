<?php

namespace App\Repositories;

use App\Entities\Document;

class DocumentRepository extends Repository
{
    public function __construct(Document $document)
    {
        $this->object = $document;
    }
}
