<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'studio_id', 'client_name', 'email', 'phone', 'notes',
        'photo_format', 'quantity', 'price', 'deposit', 'order_status', 'payment_status',
        'created_by_id',
    ];

    public function getNameAttribute() {
        return $this->client_name;
    }

    public function getRemainingBalanceAttribute() {
        return $this->price - $this->deposit;
    }

    public function getPaymentStatusAutoAttribute() {
        return $this->deposit >= $this->price ? 'paid' : 'pending';
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }


    public function gallery()
    {
        return $this->hasOne(Gallery::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}
