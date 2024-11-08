<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use \App\Models\Network;
use \App\Http\Requests\UpdateNetworkRequest;
use \App\Http\Requests\CreateNetworkRequest;

class NetworksController extends Controller
{
    public function index()
    {
        // TODO pagination
        return response()->json(['networks' => Network::all()]);
    }

    public function show(Network $network)
    {
        return response()->json(['network' => $network,]);
    }

    public function store(CreateNetworkRequest $request)
    {
        $request_parameters = $request->validated();

        $network = Network::create($request_parameters['network']);

        return response()->json(['network' => $network,]);
    }

    public function update(Network $network, UpdateNetworkRequest $request)
    {
        $request_parameters = $request->validated();
        $network->update($request_parameters['network'] ?? []);
        return response()->json(['network' => $network,]);
    }
}
