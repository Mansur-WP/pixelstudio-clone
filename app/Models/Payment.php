<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'studio_id', 'invoice_id', 'amount', 'method', 'notes', 'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
