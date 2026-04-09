<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'studio_id', 'client_id', 'amount', 'status', 'description', 'due_date', 'invoice_number',
    ];

    protected static function booted()
    {
        static::creating(function ($invoice) {
            $last = \App\Models\Invoice::latest()->first();
            $number = $last ? intval(substr($last->invoice_number, 4)) + 1 : 1;
            $invoice->invoice_number = 'INV-' . str_pad($number, 4, '0', STR_PAD_LEFT);
        });
    }

    protected $casts = [
        'status' => 'string',
        'amount' => 'decimal:2',
        'due_date' => 'date',
    ];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
