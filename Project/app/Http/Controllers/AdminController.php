<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Career;
use App\Models\Multimedia;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Store a new user from Admin panel.
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:student,graduate,professional,admin',
            'education_level' => 'nullable|string|max:255',
            'interests' => 'nullable|string|max:255',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return redirect()->route('dashboard', ['tab' => 'users'])->with('success', "User '{$user->name}' created successfully!");
    }

    /**
     * Toggle or update user role.
     */
    public function updateUserRole(Request $request, $id)
    {
        $targetUser = User::findOrFail($id);

        if ($targetUser->email === 'admin@pathseeker.com' && $request->input('role') !== 'admin') {
            return redirect()->route('dashboard', ['tab' => 'users'])->with('error', 'The primary Root Administrator role cannot be demoted.');
        }

        $newRole = $request->input('role');
        if (!in_array($newRole, ['student', 'graduate', 'professional', 'admin'])) {
            $newRole = ($targetUser->role === 'admin') ? 'student' : 'admin';
        }

        $targetUser->role = $newRole;
        $targetUser->save();

        return redirect()->route('dashboard', ['tab' => 'users'])->with('success', "Role for '{$targetUser->name}' updated to '{$newRole}' successfully!");
    }

    /**
     * Delete user from system.
     */
    public function deleteUser($id)
    {
        $targetUser = User::findOrFail($id);

        if ($targetUser->email === 'admin@pathseeker.com' || (Auth::check() && Auth::id() == $targetUser->id)) {
            return redirect()->route('dashboard', ['tab' => 'users'])->with('error', 'Cannot delete the active logged-in administrator account.');
        }

        $userName = $targetUser->name;
        $targetUser->delete();

        return redirect()->route('dashboard', ['tab' => 'users'])->with('success', "User '{$userName}' removed from system.");
    }

    /**
     * Store new Career Track.
     */
    public function storeCareer(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'domain' => 'required|string|max:255',
            'required_skills' => 'required|string',
            'expected_salary' => 'required|string|max:255',
        ]);

        $career = Career::create($validated);

        return redirect()->route('dashboard', ['tab' => 'careers'])->with('success', "Career Track '{$career->title}' published successfully!");
    }

    /**
     * Update existing Career Track.
     */
    public function updateCareer(Request $request, $id)
    {
        $career = Career::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'domain' => 'required|string|max:255',
            'required_skills' => 'required|string',
            'expected_salary' => 'required|string|max:255',
        ]);

        $career->update($validated);

        return redirect()->route('dashboard', ['tab' => 'careers'])->with('success', "Career Track '{$career->title}' updated successfully!");
    }

    /**
     * Delete Career Track.
     */
    public function deleteCareer($id)
    {
        $career = Career::findOrFail($id);
        $title = $career->title;
        $career->delete();

        return redirect()->route('dashboard', ['tab' => 'careers'])->with('success', "Career Track '{$title}' deleted successfully!");
    }

    /**
     * Store Multimedia Asset.
     */
    public function storeMultimedia(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:video,audio',
            'url' => 'required|url',
            'thumbnail_url' => 'nullable|url',
            'duration' => 'nullable|string|max:50',
            'tags' => 'nullable|string',
        ]);

        $media = Multimedia::create($validated);

        return redirect()->route('dashboard', ['tab' => 'multimedia'])->with('success', "Multimedia asset '{$media->title}' published successfully!");
    }

    /**
     * Delete Multimedia Asset.
     */
    public function deleteMultimedia($id)
    {
        $media = Multimedia::findOrFail($id);
        $title = $media->title;
        $media->delete();

        return redirect()->route('dashboard', ['tab' => 'multimedia'])->with('success', "Multimedia asset '{$title}' deleted successfully!");
    }

    /**
     * Store Resource Toolkit.
     */
    public function storeResource(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'file_url' => 'required|url',
            'thumbnail_url' => 'nullable|url',
        ]);

        $res = Resource::create($validated);

        return redirect()->route('dashboard', ['tab' => 'resources'])->with('success', "Resource Blueprint '{$res->title}' added successfully!");
    }

    /**
     * Delete Resource Toolkit.
     */
    public function deleteResource($id)
    {
        $res = Resource::findOrFail($id);
        $title = $res->title;
        $res->delete();

        return redirect()->route('dashboard', ['tab' => 'resources'])->with('success', "Resource Blueprint '{$title}' deleted successfully!");
    }
}
