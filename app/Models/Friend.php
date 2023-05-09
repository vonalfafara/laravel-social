<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "friends_with"
    ];

    public function users(): HasMany {
        return $this->hasMany(User::class);
    }

    public function friend(): BelongsTo {
        return $this->belongsTo(User::class, "friends_with");
    }

    public function friends(): HasMany {
        return $this->hasMany(User::class, "friends_with");
    }
}
