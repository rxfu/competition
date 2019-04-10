<?php

namespace App\Http\Controllers;

use App\Services\DocumentService;

class DocumentController extends BaseController
{
    protected $module = 'document';

    protected $storeRules = [
        'name' => 'required',
    ];

    public function __construct(DocumentService $documentService)
    {
        $this->service = $documentService;

        $this->updateRules = $this->storeRules;
    }
}
