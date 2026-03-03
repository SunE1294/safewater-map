<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use Illuminate\Http\Request;
use App\Models\Tubewell;

// 1. Home Page: Load Map with existing data
Route::get('/', [MapController::class, 'index']);

// 2. Submit Data: Handle coordinates, area name, and image upload
Route::post('/submit-well', function (Request $request) {
    
    // Validate inputs
    $request->validate([
        'lat' => 'required',
        'lng' => 'required',
        'area_name' => 'required|string|max:255',
        'status' => 'required|in:safe,danger,untested',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Max 2MB
    ]);

    $imagePath = null;
    
    // Handle File Upload
    if ($request->hasFile('image')) {
        // This saves the image to: storage/app/public/tubewells
        $imagePath = $request->file('image')->store('tubewells', 'public');
    }

    // Save to Database
    Tubewell::create([
        'lat' => $request->lat,
        'lng' => $request->lng,
        'area_name' => $request->area_name,
        'status' => $request->status,
        'image' => $imagePath,
        'is_verified' => false, // New data stays unverified initially
    ]);

    return back()->with('success', 'Data submitted with photo! Admin will verify soon.');
});