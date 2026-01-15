<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeocodeController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->query();
        $query['format'] = $query['format'] ?? 'json';

        $contactEmail = env('GEOCODER_CONTACT_EMAIL');
        if ($contactEmail && empty($query['email'])) {
            $query['email'] = $contactEmail;
        }

        $appName = config('app.name', 'TastyIgniter');
        $appUrl = config('app.url');
        $userAgent = trim($appName.' ('.$appUrl.')');

        $response = Http::timeout(10)
            ->retry(2, 200)
            ->withHeaders([
                'User-Agent' => $userAgent,
                'Referer' => $appUrl,
            ])
            ->get('https://nominatim.openstreetmap.org/search', $query);

        return response($response->body(), $response->status())
            ->header('Content-Type', $response->header('Content-Type', 'application/json'));
    }
}
