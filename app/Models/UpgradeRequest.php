<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpgradeRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'studio_id', 'plan_requested', 'status', 'requested_at', 'reviewed_at',
    ];

    protected $casts = [
        'status' => 'string',
        'requested_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
}
