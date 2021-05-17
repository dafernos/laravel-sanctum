<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Genre extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function discs()
    {
        return $this->belongsToMany(Disc::class, 'genre_discs');
    }

    public function scopeList(Builder $query)
    {
        $query->with('discs');
        return $query;
    }

    public function scopeDetail(Builder $query, $id)
    {
        $query->where('id','=',$id)
            ->with('discs');
        return $query;
    }

}
