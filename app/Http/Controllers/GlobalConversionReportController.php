<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use \Illuminate\Http\Response;
use \App\Jobs\GenerateGlobalConversionsReport;
use \App\Exceptions\RateLimitedException;
use Illuminate\Support\Facades\RateLimiter;

class GlobalConversionReportController extends Controller
{
    public function store(Request $request)
    {
        $executed = RateLimiter::attempt(
            'generate-global-conversions-report:' . $request->user()->id,
            $limit = 10,
            function () {},
            $period_length = 30
        );

        if ($executed === false) {
            throw new RateLimitedException();
        } else {
            GenerateGlobalConversionsReport::dispatch();
        }

        return response()->noContent(Response::HTTP_ACCEPTED);
    }
}
