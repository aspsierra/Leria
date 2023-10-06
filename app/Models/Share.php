<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Share extends Model
{
    use HasFactory;

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function post(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
