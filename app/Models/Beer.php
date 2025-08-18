<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Beer extends Model
{
    protected $fillable = ['name', 'brewery', 'style', 'abv', 'city', 'image'];

    protected $casts = [
        'abv' => 'float',
    ];

    protected $appends = ['image_url', 'image_path'];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function reviewers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'reviews')
            ->withPivot(['rating', 'comment'])
            ->withTimestamps();
    }

    public function averageRating(): float
    {
        return round((float) ($this->reviews()->avg('rating') ?? 0), 1);
    }

    public function reviewsCount(): int
    {
        return (int) $this->reviews()->count();
    }

    /**
     * Bestandsnaam-kandidaten (alleen de filename, zonder pad).
     * Bv. ["JambeDeBois.jpg", "JambeDeBois.png", "jambedebois.jpg", ...]
     */
    protected function candidateImageFiles(): array
    {
        $out = [];

        // 1) Expliciete kolom 'image'
        if (!empty($this->image)) {
            $file = ltrim(basename($this->image));
            if (str_contains($file, '.')) {
                $out[] = $file;
            } else {
                foreach (['.jpg', '.jpeg', '.png', '.webp'] as $ext) {
                    $out[] = $file . $ext;
                }
            }
        }

        // 2) Afgeleiden van de naam
        $studly = (string) Str::of($this->name)->ascii()->studly();  // JambeDeBois
        $flat   = preg_replace('/[^A-Za-z0-9]/', '', (string) $this->name);
        $slug   = Str::slug($this->name, '');
        $slugHy = Str::slug($this->name, '-');

        foreach (array_filter(array_unique([$studly, $flat, $slug, $slugHy])) as $base) {
            foreach (['.jpg', '.jpeg', '.png', '.webp'] as $ext) {
                $out[] = $base . $ext;
            }
        }

        return array_values(array_unique($out));
    }

    /** Zoek in public/images/beers */
    protected function findPublicImagesRel(): ?string
    {
        foreach ($this->candidateImageFiles() as $file) {
            $rel = 'images/beers/' . $file; // relative t.o.v. public_path()
            if (File::exists(public_path($rel))) {
                return $rel;
            }
        }
        return null;
    }

    /** Zoek in storage/app/public/beers (via 'public' disk) */
    protected function findStorageImagesRel(): ?string
    {
        $disk = Storage::disk('public');
        foreach ($this->candidateImageFiles() as $file) {
            $rel = 'beers/' . $file; // relative t.o.v. public-disk
            if ($disk->exists($rel)) {
                return $rel;
            }
        }
        return null;
    }

    /** Publieke URL (gebruikt in views) */
    public function getImageUrlAttribute(): string
    {
        if ($rel = $this->findPublicImagesRel()) {
            return asset($rel); // /images/beers/...
        }

        if ($rel = $this->findStorageImagesRel()) {
            return asset('storage/' . $rel); // /storage/beers/...
        }

        return asset('images/beer-placeholder.png');
    }

    /** Handig voor debugging/andere plekken: geef het gevonden relatieve pad terug */
    public function getImagePathAttribute(): ?string
    {
        if ($rel = $this->findPublicImagesRel()) {
            return $rel; // bv. images/beers/JambeDeBois.jpg
        }
        if ($rel = $this->findStorageImagesRel()) {
            return 'storage/' . $rel; // bv. storage/beers/JambeDeBois.jpg
        }
        return null;
    }
}
