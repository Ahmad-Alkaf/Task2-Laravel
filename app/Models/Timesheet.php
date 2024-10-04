<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Timesheet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'task_name',
        'date',
        'hours',
        'user_id',
        'project_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'hours' => 'float',
        'user_id' => 'integer',
        'project_id' =>'integer',
    ];

    function project(): HasOne
    {
        return $this->hasOne(Project::class, 'project_id');
    }
    function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
