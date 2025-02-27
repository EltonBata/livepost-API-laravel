<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
    ];

    protected $casts = [
        'body' => 'array'
    ];

    protected $appends = [
      
    ];

    //Accessor
    public function getTitleUpperCaseAttribute()
    {
        return strtoupper($this->title);
    }


    //Mutator
    // public function setTitleAttribute($value)
    // {
    //     $this->attributes['title'] = strtolower($value);
    // }


    //Relationships
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id');
    }
}