<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index() {
        $staff = \App\Models\User::where('studio_id', auth()->user()->studio_id)
            ->where('role', 'staff')
            ->latest()
            ->get();
        return view('admin.staff.index', compact('staff'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        \App\Models\User::create([
            'studio_id' => auth()->user()->studio_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'staff',
            'is_active' => true,
        ]);
        \App\Models\ActivityLog::create([
            'studio_id' => auth()->user()->studio_id,
            'user_id' => auth()->id(),
            'action' => 'staff_created',
            'description' => "Added new staff member: {$request->name}",
        ]);
        return back()->with('success', 'Staff member added successfully!');
    }

    public function toggleStatus($id) {
        $staff = \App\Models\User::where('studio_id', auth()->user()->studio_id)->findOrFail($id);
        $staff->update(['is_active' => !$staff->is_active]);
        return back()->with('success', 'Staff status updated!');
    }

    public function destroy($id) {
        $staff = \App\Models\User::where('studio_id', auth()->user()->studio_id)->findOrFail($id);
        $staff->delete();
        return back()->with('success', 'Staff member removed!');
    }
}
