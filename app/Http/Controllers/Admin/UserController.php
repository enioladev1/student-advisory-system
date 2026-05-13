<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdvisorProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role  = $request->get('role', 'student');
        $users = User::where('role', $role)
            ->with(['studentProfile', 'advisorProfile'])
            ->latest()
            ->paginate(15);

        return view('admin.users.index', compact('users', 'role'));
    }

    public function createAdvisor()
    {
        return view('admin.users.create-advisor');
    }

    public function storeAdvisor(Request $request)
    {
        $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'unique:users'],
            'password'   => ['required', 'min:8', 'confirmed'],
            'staff_id'   => ['required', 'string', 'unique:advisor_profiles,staff_id'],
            'department' => ['required', 'string'],
            'faculty'    => ['required', 'string'],
            'phone'      => ['nullable', 'string'],
            'bio'        => ['nullable', 'string'],
            'max_students' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'advisor',
        ]);

        AdvisorProfile::create([
            'user_id'      => $user->id,
            'staff_id'     => $request->staff_id,
            'department'   => $request->department,
            'faculty'      => $request->faculty,
            'phone'        => $request->phone,
            'bio'          => $request->bio,
            'max_students' => $request->max_students,
        ]);

        return redirect()->route('admin.users.index', ['role' => 'advisor'])
            ->with('success', 'Advisor account created successfully.');
    }

    public function toggleStatus(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
        return back()->with('success', 'User status updated.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted.');
    }
}
