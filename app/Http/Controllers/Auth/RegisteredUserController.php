<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            'matric_number' => ['required', 'string', 'max:50', 'unique:student_profiles,matric_number'],
            'department'    => ['required', 'string', 'max:255'],
            'faculty'       => ['required', 'string', 'max:255'],
            'program'       => ['required', 'in:ND,HND,BSc,BA,BEng,BTech'],
            'level'         => ['required', 'in:100,200,300,400'],
            'phone'         => ['nullable', 'string', 'max:20'],
            'session'       => ['required', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'student',
        ]);

        StudentProfile::create([
            'user_id'       => $user->id,
            'matric_number' => $request->matric_number,
            'department'    => $request->department,
            'faculty'       => $request->faculty,
            'program'       => $request->program,
            'level'         => $request->level,
            'phone'         => $request->phone,
            'session'       => $request->session,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('student.dashboard');
    }
}
