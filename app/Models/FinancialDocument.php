<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class FinancialDocument extends Model
{

    protected $fillable = [
        'user_id',
        'period_start',
        'period_end',
        'notes'
    ];

    protected $casts = [
        'period_start' => 'date',
        'period_end' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function financialEntries()
    {
        return $this->hasMany(FinancialEntries::class);
    }
}
