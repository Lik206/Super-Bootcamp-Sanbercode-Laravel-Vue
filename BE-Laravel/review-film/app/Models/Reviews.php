<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'reviews';

    protected $fillable = [
        'critics', 'rating', 'user_id', 'movie_id'
    ];
}
