<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'birth_date',
        'gender'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'timesheets', 'user_id', 'project_id');
    }
    public function timesheets(): BelongsToMany
    {
        return $this->belongsToMany(Timesheet::class, 'timesheets');
    }


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['first_name'] ?? null, function ($query, $search) {
            $query->where('first_name', 'like', '%' . $search . '%');
        });

        $query->when($filters['last_name'] ?? null, function ($query, $search) {
            $query->where('last_name', 'like', '%' . $search . '%');
        });

        $query->when($filters['birth_date'] ?? null, function ($query, $search) {
            $query->where('birth_date', $search);
        });

        $query->when($filters['gender'] ?? null, function ($query, $search) {
            $query->where('gender', $search);
        });
    }
}
