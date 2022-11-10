<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    /**
     * add mutator for slug
     *
     * @param $value
     */
    public function setSlugAttribute($value)
    {
        $slug = $value ?? $this->name;
        $slug = Str::slug($slug);
        
        $count = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . $count;
            $count++;
        }

        $this->attributes['slug'] = $slug;
    }
}
