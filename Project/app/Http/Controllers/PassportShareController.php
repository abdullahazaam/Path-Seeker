<?php

namespace App\Http\Controllers;

use App\Models\ShareToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PassportShareController extends Controller
{
    /**
     * Generate or fetch opaque, random share token.
     */
    public function getShareLink(Request $request)
    {
        $user = Auth::user();

        $shareToken = ShareToken::firstOrCreate(
            ['user_id' => $user->id],
            ['token' => Str::random(48), 'is_active' => true]
        );

        $url = route('passport.shared', $shareToken->token);

        return response()->json([
            'share_url' => $url,
            'token' => $shareToken->token,
            'views_count' => $shareToken->views_count,
        ]);
    }

    /**
     * Public view of shared passport.
     * STRICT PRIVACY: Exposes ONLY public name, role, education level, and public competencies.
     * NEVER leaks email, password hashes, internal IDs, or private notes.
     */
    public function showSharedPassport(string $token)
    {
        $shareToken = ShareToken::where('token', $token)->where('is_active', true)->firstOrFail();
        $shareToken->increment('views_count');

        $user = $shareToken->user;

        // Build strictly filtered, privacy-safe Public DTO
        $publicProfile = [
            'display_name' => $user->name,
            'role' => ucfirst($user->role),
            'education_level' => $user->education_level ?? 'Engineering Candidate',
            'interests' => $user->interests ?? 'Full-Stack Development, Cloud Systems',
            'shared_at' => $shareToken->created_at->format('M d, Y'),
            'views_count' => $shareToken->views_count,
            'verified_status' => 'Verified PathSeeker Passport Member',
        ];

        return view('passport.shared', compact('publicProfile'));
    }
}
