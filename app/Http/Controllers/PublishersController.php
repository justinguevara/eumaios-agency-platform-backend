<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Publisher;
use \App\Http\Requests\CreatePublisherRequest;

class PublishersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // TODO pagination
        return response()
            ->json(['publishers' => Publisher::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePublisherRequest $request)
    {
        $request_parameters = $request->validated();

        $publisher = Publisher::create($request_parameters['publisher']);

        return response()
            ->json(['publisher' => $publisher,]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        return response()
            ->json(['publisher' => $publisher,]);
    }

    // TODO
    /**
     * Update the specified resource in storage.
     */
     /*
    public function update(Request $request, string $id)
    {
        //
    }
    */

    /**
     * Remove the specified resource from storage.
     */
    /*
    public function destroy(string $id)
    {
        //
    }
    */
}
