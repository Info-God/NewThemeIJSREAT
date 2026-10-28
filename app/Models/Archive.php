<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Archive extends Model
{
    protected $table = 'archives';
    protected $primaryKey = 'paper_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $casts = [
        'year' => 'integer',
        'volume' => 'integer',
        'issue' => 'integer',
    ];

    public function getArchiveUrlAttribute(): string
    {
        return '/archives/' . $this->archive_slug;
    }

    public function getArchiveSlugAttribute(): string
    {
        return $this->slugifyTitle($this->paper_title);
    }

    public function getCanonicalSlugAttribute(): string
    {
        return $this->archive_slug;
    }

    public function getCanonicalUrlAttribute(): string
    {
        return url($this->archive_url);
    }

    public function getPaperPdfUrlAttribute(): string
    {
        return 'https://www.ijsreat.com/archiver/' . ltrim((string) $this->paper_url, '/');
    }

    public function getAuthorsAttribute(): array
    {
        $raw = $this->attributes['authors'] ?? null;
        if (!empty($raw)) {
            $decoded = is_array($raw) ? $raw : json_decode($raw, true);
            if (is_array($decoded) && !empty($decoded)) {
                return array_values(array_filter(array_map('trim', $decoded)));
            }
        }

        $authors = [];

        foreach (range(1, 6) as $index) {
            $field = "author_{$index}";
            if (!empty($this->{$field})) {
                $authors[] = trim($this->{$field});
            }
        }

        if (empty($authors) && !empty($this->paper_author)) {
            $authors = array_filter(array_map('trim', preg_split('/[;,]+/', $this->paper_author)));
        }

        return array_values($authors);
    }

    protected function slugifyTitle(?string $title): string
    {
        $title = trim((string) $title);

        if ($title === '') {
            return (string) $this->paper_id;
        }

        $slug = Str::slug($title, '-');

        return $slug ?: (string) $this->paper_id;
    }
}
