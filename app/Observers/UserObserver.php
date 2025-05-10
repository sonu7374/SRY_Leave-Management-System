<?php

namespace App\Observers;

use App\Models\User;
use App\Models\LeaveBalance;
use App\Models\LeaveType;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */

    public function created(\App\Models\User $user)
    {
        foreach (LeaveType::all() as $type) {
            LeaveBalance::firstOrCreate([
                'user_id' => $user->id,
                'leave_type_id' => $type->id,
                'year' => now()->year,
            ], [
                'allocated' => $type->max_days,
                'used' => 0,
                'carried_forward' => 0,
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
