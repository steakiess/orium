<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $fillable = ['image', 'title', 'slug', 'user_id', 'published_at', 'content', 'category_id'];

    public function user()
    {
        return $this->belongsto(User::class);
    }

    public function category()
    {
        return $this->belongsto(Category::class);
    }

    public function claps()
    {
        return $this->hasMany(Clap::class);
    }

    public function readTime($wordsPerMinute = 100)
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $minutes = ceil($wordCount / $wordsPerMinute);
        return $minutes;
    }

    public function imageUrl()
    {
        if ($this->image) {
            return Storage::url($this->image);
        } else {
            return null;
        }
    }
    public function getCreatedAt()
    {
        return $this->created_at->format('M d, Y');
    }
}
