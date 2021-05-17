<?php

namespace App\Http\Resources;

use App\Models\Disc;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Disc $disc */
        $disc = $this;

        return [
            'author_name' => $disc->author,
            'title' => $disc->title,
            'album' => $disc->album,
            'genres' => new GenreCollection($this->whenLoaded('genres')),
            'created' => $disc->created_at,
            'updated' => $disc->updated_at,
            'published' => $disc->published_at,
        ];
    }
}
