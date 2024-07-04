<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'movie';

    protected $fillable = [
        'title', 'summary', 'poster', 'genre_id', 'year'
    ];

    public function genre()
    {
        return $this->belongsTo(Genres::class, 'genre_id', 'id');
    }

    public function listReviews() {
        return $this->hasMany(Reviews::class, 'movie_id');
    }

    public function listCast() {
        return $this->belongsToMany(Cast::class, 'cast_movie', 'movie_id', 'cast_id');
    }
}
