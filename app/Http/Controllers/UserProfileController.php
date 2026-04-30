<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Get the authenticated user's physical profile.
     */
    public function show()
    {
        $profile = UserProfile::where('user_id', Auth::id())->first();

        return response()->json($profile);
    }

    /**
     * Update or create the user's physical profile.
     */
    public function update(Request $request)
    {
        // Server-side validation to ensure data integrity
        $validated = $request->validate([
            'gender'         => ['required', 'in:male,female'],
            'weight'         => ['required', 'numeric', 'min:20', 'max:300'],
            'height'         => ['required', 'integer', 'min:50', 'max:250'],
            'age'            => ['required', 'integer', 'min:10', 'max:120'],
            'activity_level' => ['required', 'string'],
            'goal'           => ['required', 'string'],
        ]);

        // Logic: find by user_id, then update or create a new entry
        $profile = UserProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated
        );

        return response()->json([
            'message' => 'Profile updated successfully',
            'profile' => $profile
        ]);
    }
}
