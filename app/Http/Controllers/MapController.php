<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tubewell; // Linking the Tubewell model

class MapController extends Controller
{
    /**
     * Fetch all verified points and send them to the map view.
     */
    public function index()
    {
        // Get all tubewells marked as verified
        $tubewells = Tubewell::where('is_verified', true)->get();
        
        // Return the 'map.blade.php' view with data
        return view('map', compact('tubewells'));
    }
}