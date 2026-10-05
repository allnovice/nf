<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GoogleConnection extends Model
{
protected $fillable = [
    'user_id',
    'google_id',
    'email',
    'access_token',
    'refresh_token',
    'token_expires_at',
    'spreadsheet_id',
    'last_synced_at',
];
    protected $casts = [
        'token_expires_at' => 'datetime',
        'access_token' => 'encrypted',
        'refresh_token' => 'encrypted',
        'last_synced_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
