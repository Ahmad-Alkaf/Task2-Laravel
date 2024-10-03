<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'timesheets', 'project_id', 'user_id');
    }
    public function timesheets(): BelongsToMany
    {
        return $this->belongsToMany(Timesheet::class, 'timesheets');
    }
}
