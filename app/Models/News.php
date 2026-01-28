<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'status',
        'published_date',
        'views',
        'author_id'
    ];

    protected $casts = [
        'published_date' => 'date',
        'views' => 'integer',
    ];

    /**
     * Relationship with User (Author)
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Scope for published news only
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->where('published_date', '<=', now());
    }

    /**
     * Scope for latest news
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('published_date', 'desc');
    }

    /**
     * Auto-generate slug from title
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    /**
     * Increment views counter
     */
    public function incrementViews()
    {
        $this->increment('views');
    }

    /**
     * Get formatted published date
     */
    public function getFormattedDateAttribute()
    {
        return $this->published_date->format('d F Y');
    }

    /**
     * Get status badge HTML
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'published' => '<span class="badge bg-success">Published</span>',
            'draft' => '<span class="badge bg-warning">Draft</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }
}