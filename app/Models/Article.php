<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    protected $attributes = [
        'status' => null,
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * add mutator for name
     *
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
    }

    /**
     * add mutator for status
     * set status attribute to 1 if is null
     *
     * @param $value
     */
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value ?? 1;
    }

}
