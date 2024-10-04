<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'department',
        'start_date',
        'end_date',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'timesheets', 'project_id', 'user_id');
    }
    public function timesheets(): BelongsToMany
    {
        return $this->belongsToMany(Timesheet::class, 'timesheets');
    }
}
