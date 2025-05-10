<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use App\Models\LeaveBalance;
use App\Notifications\LeaveRequestNotification;


class ManagerLeaveController extends Controller
{
    public function show($id)
    {
        // If you don't need it, you can simply redirect or abort
        return redirect()->route('leave-approval.index');
    }
    public function index()
    {
        $leaveRequests = \App\Models\LeaveRequest::with(['leaveType', 'user'])->orderBy('created_at', 'desc')->get();

        // Add total_days and leave_balance for each request
        foreach ($leaveRequests as $request) {
            $start = \Carbon\Carbon::parse($request->start_date);
            $end = \Carbon\Carbon::parse($request->end_date);

            // Calculate total leave days (inclusive of start and end date)
            $request->total_days = $start->diffInDays($end) + 1;
            // Get leave balance record for the user & leave type
            $balance = \App\Models\LeaveBalance::where('user_id', $request->user_id)
                ->where('leave_type_id', $request->leave_type_id)
                ->where('year', now()->year)
                ->first();
            //dd($balance);
            $request->allocated_days = $balance?->allocated ?? 0;
            $request->used_days = $balance?->used ?? 0;
            $request->remaining_days = ($balance?->allocated ?? 0) - ($balance?->used ?? 0);
        }
        //dd($leaveRequests);
        return view('manager.leave-approval.index', compact('leaveRequests'));
    }
    public function update(Request $request, $id)
    {
        $leaveRequest = LeaveRequest::with('leaveType')->findOrFail($id);
        $action = $request->input('action');

        if ($action === 'approve') {
            // Calculate total days
            $start = \Carbon\Carbon::parse($leaveRequest->start_date);
            $end = \Carbon\Carbon::parse($leaveRequest->end_date);
            $days = $start->diffInDays($end) + 1;

            // Get leave balance
            $leaveBalance = LeaveBalance::where('user_id', $leaveRequest->user_id)
                ->where('leave_type_id', $leaveRequest->leave_type_id)
                ->where('year', now()->year)
                ->first();

            if (!$leaveBalance) {
                return back()->with('error', 'Leave balance not found.');
            }

            if ($leaveBalance->allocated - $leaveBalance->used < $days) {
                return back()->with('error', 'Not enough leave balance.');
            }

            // Approve request
            $leaveRequest->status = 'approved';
            $leaveRequest->save();

            // Update used days
            $leaveBalance->used += $days;
            $leaveBalance->save();
            // ✅ Notify the user (employee)
            $leaveRequest->user->notify(new LeaveRequestNotification($leaveRequest, 'approved'));

            return back()->with('success', 'Leave approved.');
        }

        if ($action === 'reject') {
            // Rollback used days if the leave was already approved
            if ($leaveRequest->status === 'approved') {
                $start = \Carbon\Carbon::parse($leaveRequest->start_date);
                $end = \Carbon\Carbon::parse($leaveRequest->end_date);
                $days = $start->diffInDays($end) + 1;

                $leaveBalance = LeaveBalance::where('user_id', $leaveRequest->user_id)
                    ->where('leave_type_id', $leaveRequest->leave_type_id)
                    ->where('year', now()->year)
                    ->first();

                if ($leaveBalance) {
                    $leaveBalance->used -= $days;
                    if ($leaveBalance->used < 0) {
                        $leaveBalance->used = 0; // safety check
                    }
                    $leaveBalance->save();
                }
            }

            // Change status to rejected
            $leaveRequest->status = 'rejected';
            $leaveRequest->save();
            // ✅ Notify the user (employee)
            $leaveRequest->user->notify(new LeaveRequestNotification($leaveRequest, 'rejected'));
            return back()->with('success', 'Leave rejected.');
        }


        return back()->with('error', 'Invalid action.');
    }
}
