<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    /**
     * Show the profile edit and settings form.
     */
    public function edit()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $profile = $user->profile ?? new UserProfile();

        return view('profile.edit', compact('user', 'profile'));
    }

    /**
     * Update the user profile details, resume, and password.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'education_level' => ['nullable', 'string', 'max:100'],
            'interests' => ['nullable', 'string', 'max:500'],
            'skills' => ['nullable', 'string', 'max:1000'],
            'work_experience' => ['nullable', 'string', 'max:3000'],
            'resume' => ['nullable', 'file', 'mimes:pdf,docx,doc', 'max:10240'],
            'current_password' => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['new_password'])) {
            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        $profileData = [
            'education_level' => $validated['education_level'] ?? null,
            'interests' => $validated['interests'] ?? null,
            'skills' => $validated['skills'] ?? null,
            'work_experience' => $validated['work_experience'] ?? null,
        ];

        // Handle Resume Upload
        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            $originalName = $file->getClientOriginalName();
            $path = $file->store('resumes', 'public');
            
            $profileData['resume_path'] = $path;
            $profileData['resume_filename'] = $originalName;
            $profileData['resume_updated_at'] = now();
        }

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        return redirect()->route('profile.edit')->with('success', 'Profile and credentials updated successfully!');
    }

    /**
     * Download the authenticated user's uploaded resume.
     */
    public function downloadResume()
    {
        $user = Auth::user();
        if (!$user || !$user->profile || !$user->profile->resume_path) {
            return redirect()->route('profile.edit')->with('error', 'No resume file found.');
        }

        $path = $user->profile->resume_path;
        if (!Storage::disk('public')->exists($path)) {
            return redirect()->route('profile.edit')->with('error', 'Resume file not found on server.');
        }

        $filename = $user->profile->resume_filename ?? 'resume.pdf';

        return Storage::disk('public')->download($path, $filename);
    }
}
