<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Notifications\Notifiable;
use Modules\Courses\Models\Course;
use Modules\Users\Filters\TeacherFilter;

class Teacher extends BaseAuthenticatableUser
{
    use Notifiable;

    public const TABLE = 'teachers';

    public const GUARD = 'graph_teacher';
    public const ROLE = 'teacher';

    protected $table = self::TABLE;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
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

    public function modelFilter(): string
    {
        return TeacherFilter::class;
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function courses(): MorphMany
    {
        return $this->morphMany(Course::class, 'creator');
    }
}
