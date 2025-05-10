<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;

class ManagerController extends Controller
{
    public function dashboard()
    {
        // Show only pending leave requests from employees
        $leaveRequests = LeaveRequest::with('user', 'leaveType')
            ->where('status', 'pending')
            ->get();

        return view('manager.dashboard', compact('leaveRequests'));
    }
}
