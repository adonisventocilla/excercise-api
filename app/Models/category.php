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
     * add mutator for name
     * set slug attribute from name
     * set slug attribute when is duplicated
     *
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        $slug = Str::slug($value);
        $count = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = Str::slug($value) . '-' . $count;
            $count++;
        }

        $this->attributes['slug'] = $slug;
    }

    /**
     * add mutator for slug
     *
     * @param $value
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = $value;
    }
}
