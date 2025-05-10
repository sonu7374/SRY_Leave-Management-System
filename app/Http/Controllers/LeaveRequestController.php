<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\User;
use App\Notifications\LeaveRequestNotification;

class LeaveRequestController extends Controller
{

    public function index()
    {
        $leaveRequests = LeaveRequest::with('leaveType')->where('user_id', auth()->id())->latest()->get();
        $leaveTypes = \App\Models\LeaveType::all();
        return view('leave_requests.index', compact('leaveRequests', 'leaveTypes'));
    }


    public function create()
    {
        $leaveTypes = \App\Models\LeaveType::all();
        return view('leave_requests.create', compact('leaveTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'leave_type' => 'required|exists:leave_types,id',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'reason' => 'required|string',
        ]);

        $leaveRequest = LeaveRequest::create([
            'user_id' => auth()->id(),
            'leave_type_id' => $request->leave_type, // assuming the DB column is leave_type_id
            'start_date' => $request->from_date,
            'end_date' => $request->to_date,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);
        // ✅ Notify all managers
        foreach (User::where('role', 'manager')->get() as $manager) {
            $manager->notify(new LeaveRequestNotification($leaveRequest, 'created'));
        }
        return redirect()->route('leave-requests.create')->with('success', 'Leave request submitted.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'leave_type' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:255',
        ]);

        $leaveRequest = LeaveRequest::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $leaveRequest->update([
            'leave_type_id' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
        ]);

        return redirect()->route('leave-requests.index')->with('success', 'Leave request updated successfully.');
    }
    public function destroy($id)
    {
        $leaveRequest = LeaveRequest::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $leaveRequest->delete();

        return redirect()->route('leave-requests.index')->with('success', 'Leave request deleted successfully.');
    }
}
