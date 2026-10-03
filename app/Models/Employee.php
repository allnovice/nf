<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $fillable = [
        'code',
        'name',
        'position',
        'department',
        'phone',
        'email',
        'photo',
        'bio',
    ];
public function socialLinks(): HasMany
{
    return $this->hasMany(SocialLink::class);
}
}
