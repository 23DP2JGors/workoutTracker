<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Measurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the user's measurements.
     */
    public function index()
    {
        // Get all measurements for the current user, ordered by date
        return Auth::user()->measurements()
            ->orderBy('measured_at', 'desc')
            ->get();
    }

    /**
     * Store a new measurement entry.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'measured_at' => 'required|date|before_or_equal:today',
            'weight'      => 'nullable|numeric|between:0,500',
            'neck'        => 'nullable|numeric|between:0,100',
            'chest'       => 'nullable|numeric|between:0,300',
            'biceps'      => 'nullable|numeric|between:0,100',
            'forearms'    => 'nullable|numeric|between:0,100',
            'waist'       => 'nullable|numeric|between:0,300',
            'hips'        => 'nullable|numeric|between:0,300',
            'calves'      => 'nullable|numeric|between:0,100',
            'notes'       => 'nullable|string|max:200',
        ]);

        return Auth::user()->measurements()->create($validated);
    }

    /**
     * Update the specified measurement.
     */
    public function update(Request $request, Measurement $measurement)
    {
        // Ensure the user owns this measurement
        if ($measurement->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'measured_at' => 'required|date|before_or_equal:today',
            'weight'      => 'nullable|numeric|between:0,500',
            'neck'        => 'nullable|numeric|between:0,100',
            'chest'       => 'nullable|numeric|between:0,300',
            'biceps'      => 'nullable|numeric|between:0,100',
            'forearms'    => 'nullable|numeric|between:0,100',
            'waist'       => 'nullable|numeric|between:0,300',
            'hips'        => 'nullable|numeric|between:0,300',
            'calves'      => 'nullable|numeric|between:0,100',
            'notes'       => 'nullable|string|max:200',
        ]);

        $measurement->update($validated);

        return $measurement;
    }

    /**
     * Remove the specified measurement.
     */
    public function destroy(Measurement $measurement)
    {
        // Ensure the user owns this measurement
        if ($measurement->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $measurement->delete();

        return response()->noContent();
    }
}
