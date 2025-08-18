<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'image'];

    protected $appends = ['image_url', 'image_path'];

    /** Kandidaten-bestandsnamen obv 'image' of afgeleid van 'title' */
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

        // 2) Afgeleid van title
        $title  = (string) $this->title;
        $studly = (string) Str::of($title)->ascii()->studly(); // BomaLanceertBierkeBoma
        $flat   = preg_replace('/[^A-Za-z0-9]/', '', $title);
        $slug   = Str::slug($title, '');
        $slugHy = Str::slug($title, '-');

        foreach (array_filter(array_unique([$studly, $flat, $slug, $slugHy])) as $base) {
            foreach (['.jpg', '.jpeg', '.png', '.webp'] as $ext) {
                $out[] = $base . $ext;
            }
        }

        return array_values(array_unique($out));
    }

    /** Zoek in public/images/news */
    protected function findPublicImagesRel(): ?string
    {
        foreach ($this->candidateImageFiles() as $file) {
            $rel = 'images/news/' . $file;
            if (File::exists(public_path($rel))) {
                return $rel;
            }
        }
        return null;
    }

    /** Zoek in storage/app/public/news (via 'public' disk) */
    protected function findStorageImagesRel(): ?string
    {
        $disk = Storage::disk('public');
        foreach ($this->candidateImageFiles() as $file) {
            $rel = 'news/' . $file;
            if ($disk->exists($rel)) {
                return $rel;
            }
        }
        return null;
    }

    /** Publieke URL voor in views */
    public function getImageUrlAttribute(): string
    {
        if ($rel = $this->findPublicImagesRel()) {
            return asset($rel);                // /images/news/...
        }
        if ($rel = $this->findStorageImagesRel()) {
            return asset('storage/' . $rel);   // /storage/news/...
        }
        return asset('images/news-placeholder.png');
    }

    /** Relatief pad (handig voor debugging) */
    public function getImagePathAttribute(): ?string
    {
        if ($rel = $this->findPublicImagesRel()) {
            return $rel;
        }
        if ($rel = $this->findStorageImagesRel()) {
            return 'storage/' . $rel;
        }
        return null;
    }
}
