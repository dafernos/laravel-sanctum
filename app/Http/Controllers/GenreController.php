<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Http\Resources\GenreCollection;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;


class GenreController extends Controller
{
    /**
     * Listing of the resource.
     *
     * @return JsonResponse
     */
    public function list() : JsonResponse
    {
        $genre = Genre::list()->get();

        return (new GenreCollection($genre))->response();
    }

    /**
     * Search a resource.
     *
     * @return JsonResponse
     */
    public function findById($id) : JsonResponse
    {
        if(empty($id))
            return response()->json(['error' => 'Not Found'], 401);

        $genre = Genre::detail($id)
            ->firstOrFail();

        return (new GenreResource($genre))->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGenreRequest $request
     * @return JsonResponse
     */
    public function store(StoreGenreRequest $request) : JsonResponse
    {
        $genre = Genre::create($request->toArray());
        $genre->addDiscs($request->discs);

        return (new GenreResource($genre))->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGenreRequest $request
     * @param Genre $genre
     * @return JsonResponse
     */
    public function update(UpdateGenreRequest $request, Genre $genre) : JsonResponse
    {
        if($genre === null){
            return response()->json(['error' => 'Not Found'],401);
        }
        if(!$genre->update($request->toArray())) {
            return response()->json(['error' => 'Not Updated'], 401);
        }

        return (new GenreResource($genre))->response();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Genre $genre
     * @return bool
     */
    public function destroy(Genre $genre) : bool
    {
        return $genre->delete();
    }
}
