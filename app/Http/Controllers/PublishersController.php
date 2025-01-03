<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Publisher;
use \App\Http\Requests\CreatePublisherRequest;
use \App\Http\Requests\UpdatePublisherRequest;
use \App\Http\Resources\PublisherCollection;
use \App\Http\Resources\PublisherResource;

class PublishersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return new PublisherCollection(Publisher::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePublisherRequest $request)
    {
        $request_parameters = $request->validated();

        $publisher = Publisher::create($request_parameters['publisher']);
        return new PublisherResource($publisher);
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        return new PublisherResource($publisher);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePublisherRequest $request, Publisher $publisher)
    {
        $request_parameters = $request->validated();
        $publisher->update($request_parameters['publisher'] ?? []);
        return new PublisherResource($publisher);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy (Publisher $publisher)
    {
        $id = $publisher->id;
        $publisher->delete();
        return response()->json(['message' => "Publisher {$id} deleted."]);
    }
}
