<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
class RetryService
{
    public function retryFailedJob(string $uuid)
    {
        $connection = Session::get('selected_db', 'client');

        $url = match ($connection) {
            'admin' => config('services.monitor.admin_url'),
            default => config('services.monitor.client_url'),
        };

        $endpoint = $url . '/jobs/retry';

        $response = Http::post($endpoint, [
            'uuid' => $uuid,
            'token' => config('services.monitor.token'),
        ]);
        return $response;

    }
}
