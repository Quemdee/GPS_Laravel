<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GpsData;

class GpsController extends Controller
{
    // Method to store the GPS coordinates
    public function store(Request $request)
    {
        // Validate the incoming request to ensure latitude and longitude are present
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Create a new GPS data record
        $gpsData = GpsData::create([
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
        ]);

        // Return the created GPS data as JSON
        return response()->json($gpsData);
    }
}