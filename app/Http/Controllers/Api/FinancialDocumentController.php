<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FinancialDocumentRequest;
use App\Services\FinancialDocumentService;

class FinancialDocumentController extends Controller
{
    public $financialDocumentService;
    public function __construct(FinancialDocumentService $financialDocumentService)
    {
        $this->financialDocumentService = $financialDocumentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(FinancialDocumentRequest $request) {
        $savedDocument = $this->financialDocumentService->create($request);
        return response()->json([
            'message' => "Document create with success",
            'financial_document' => 
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
}
