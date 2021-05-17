<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiscRequest;
use App\Http\Requests\UpdateDiscRequest;
use App\Http\Resources\DiscCollection;
use App\Http\Resources\DiscResource;
use App\Models\Disc;
use Illuminate\Http\JsonResponse;


class DiscController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function list() : JsonResponse
    {
        $discs = Disc::list()->get();

        return (new DiscCollection($discs))->response();
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

        $disc = Disc::detail($id)
            ->firstOrFail();

        return (new DiscResource($disc))->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDiscRequest $request
     * @return JsonResponse
     */
    public function store(StoreDiscRequest $request) : JsonResponse
    {
        $disc = Disc::create($request->toArray());
        $disc->addDiscs($request->genres);

        return (new DiscResource($disc))->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDiscRequest $request
     * @param Disc $disc
     * @return JsonResponse
     */
    public function update(UpdateDiscRequest $request, Disc $disc) : JsonResponse
    {
        if($disc === null){
            return response()->json(['error' => 'Not Found'],401);
        }
        if(!$disc->update($request->toArray())) {
            return response()->json(['error' => 'Not Updated'], 401);
        }

        return (new DiscResource($disc))->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Disc $disc
     * @return bool
     */
    public function destroy(Disc $disc) : bool
    {
        return $disc->delete();
    }
}
