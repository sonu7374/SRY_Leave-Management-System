<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class LeaveType extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'max_days', 'carry_forward', 'description'];
}
