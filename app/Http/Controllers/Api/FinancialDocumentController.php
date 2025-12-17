<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FinancialDocumentRequest;
use App\Http\Resources\FinancialDocumentResource;
use App\Services\Interface\FinancialDocumentService;
use Illuminate\Support\Facades\Log;

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


    public function store(FinancialDocumentRequest $request)
    {
        $storedDocument =  $this->financialDocumentService->store($request);
        return response()->json([
            'financial_document' => new FinancialDocumentResource($storedDocument)
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
