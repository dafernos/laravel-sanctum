<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disc extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'author',
        'title',
        'album',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];


    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_discs');
    }

    public function scopeList(Builder $query)
    {
        $query->with('genres');
        return $query;
    }

    public function scopeDetail(Builder $query, $id)
    {
        $query->where('id','=',$id)
            ->with('genres');
        return $query;
    }
}
