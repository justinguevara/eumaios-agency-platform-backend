<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use \App\Models\Campaign;
use \App\Http\Requests\UpdateCampaignRequest;
use \App\Http\Requests\CreateCampaignRequest;

class CampaignsController extends Controller
{
    public function index()
    {
        // TODO pagination
        return response()->json(['campaigns' => Campaign::all()]);
    }

    public function show(Campaign $campaign)
    {
        // TODO refactor
        $campaign->publisher_ids = array_map(
            function ($i) {
                return $i['id'];
            },
            $campaign->publishers->toArray()
        );

        return response()->json(['campaign' => $campaign,]);
    }

    public function store(CreateCampaignRequest $request)
    {
        $request_parameters = $request->validated();

        $campaign = Campaign::create($request_parameters['campaign']);
        // TODO
        $campaign->publishers()->sync($request_parameters['campaign']['publisher_ids'] ?? []);

        return response()->json(['campaign' => $campaign,]);
    }

    public function update(Campaign $campaign, UpdateCampaignRequest $request)
    {
        $request_parameters = $request->validated();
        $campaign->update($request_parameters['campaign'] ?? []);
        // TODO
        $campaign->publishers()->sync($request_parameters['campaign']['publisher_ids'] ?? []);

        return response()->json(['campaign' => $campaign,]);
    }
}
