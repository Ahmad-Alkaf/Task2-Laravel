<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Timesheet extends Model
{
    use HasFactory;

    function project(): HasOne
    {
        return $this->hasOne(Project::class, 'project_id');
    }
    function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
