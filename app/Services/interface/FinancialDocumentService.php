<?php

namespace App\Services\interface;

use App\Http\Requests\FinancialDocumentRequest;
use App\Models\FinancialDocument;

interface FinancialDocumentService
{
    function store(FinancialDocumentRequest | array $request);
}
