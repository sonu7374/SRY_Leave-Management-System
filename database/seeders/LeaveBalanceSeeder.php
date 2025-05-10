<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\LeaveType;
use App\Models\LeaveBalance;

class LeaveBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        foreach (User::all() as $user) {
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
    }
}
