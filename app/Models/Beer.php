<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Beer extends Model
{
    protected $fillable = ['name', 'brewery', 'style', 'abv', 'city'];

    public function reviews(): HasMany {
        return $this->hasMany(Review::class);
    }

    public function reviewers(): BelongsToMany {
        return $this->belongsToMany(User::class, 'reviews')
            ->withPivot(['rating', 'comment'])
            ->withTimestamps();
    }

    public function averageRating(): float {
        return round((float) ($this->reviews()->avg('rating') ?? 0), 1);
    }

    public function reviewsCount(): int {
        return (int) $this->reviews()->count();
    }
}
