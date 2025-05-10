<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class UserManagementController extends Controller
{
    // Display list of users
    public function index()
    {
        $users = User::all();
        return view('admin.user-management.index', compact('users'));
    }

    // Show the form to create a new user
    public function create()
    {
        return view('admin.user-management.create');
    }

    public function show()
    {
        $users = User::all();
        return view('admin.user-management.show', compact('users'));
    }
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status; // toggle
        $user->save();

        return back()->with('success', 'User status updated!');
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting the currently authenticated user or admin
        if ($user->id === auth()->user()->id || $user->role === 'admin') {
            return redirect()->route('user-management.index')->with('error', 'You cannot delete this user.');
        }

        $user->delete();

        return redirect()->route('user-management.index')->with('success', 'User deleted successfully.');
    }
}
