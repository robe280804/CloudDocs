<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialEntries extends Model
{
    //
    protected  $fillable = [
        'financial_document_id',
        'title',
        'description',
        'date',
        'amount',
        'type',
        'currency'
    ];

    protected $cast = [
        'date' => 'date',
    ];

    public function financialDocument()
    {
        return $this->belongsTo(FinancialDocument::class);
    }
}
