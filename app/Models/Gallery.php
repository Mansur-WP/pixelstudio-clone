<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'studio_id', 'client_id', 'token', 'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($gallery) {
            $gallery->token = Str::random(32);
        });
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class)->with('photos');
    }

    public static function generateToken($length = 32)
    {
        return Str::random($length);
    }
}
