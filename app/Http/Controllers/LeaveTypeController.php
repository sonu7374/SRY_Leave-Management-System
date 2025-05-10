<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveType;
use App\Models\LeaveBalance;
use App\Models\User;
use App\Notifications\LeaveRequestNotification;


class LeaveTypeController extends Controller
{
    public function create()
    {
        return view('admin.leave_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'max_days' => 'required|integer|min:1',
            'carry_forward' => 'required|boolean',
        ]);

        // 1. Create the new leave type
        $leaveType = LeaveType::create($request->only('name', 'max_days', 'carry_forward', 'description'));

        // 2. Create leave balances for all existing employees
        $employees = User::where('role', 'employee')->get();
        foreach ($employees as $employee) {
            LeaveBalance::firstOrCreate([
                'user_id' => $employee->id,
                'leave_type_id' => $leaveType->id,
                'year' => now()->year,
            ], [
                'allocated' => $leaveType->max_days,
                'used' => 0,
                'carried_forward' => 0,
            ]);
        }

        return redirect()->route('leave-types.create')->with('success', 'Leave type created and leave balances assigned!');
    }

    public function index()
    {
        $leaveTypes = LeaveType::all();
        return view('admin.leave_types.index', compact('leaveTypes'));
    }
    public function update(Request $request, LeaveType $leaveType)
    {
        $leaveType->update($request->all());
        return redirect()->back()->with('success', 'Leave type updated.');
    }
    public function destroy($id)
    {
        $leaveType = LeaveType::findOrFail($id);
        $leaveType->delete(); // Soft delete
        return redirect()->route('leave-types.index')->with('success', 'Leave Type deleted successfully.');
    }
}
