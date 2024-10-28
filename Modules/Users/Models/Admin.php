<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Notifications\Notifiable;
use Modules\Courses\Models\Course;
use Modules\Users\Filters\AdminFilter;

class Admin extends BaseAuthenticatableUser
{
    use Notifiable;

    public const TABLE = 'admins';

    public const GUARD = 'graph_admin';
    public const ROLE = 'admin';
    public const SUPER_ADMIN_ROLE = 'super_admin';

    protected $table = self::TABLE;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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
        return AdminFilter::class;
    }

    public function courses(): MorphMany
    {
        return $this->morphMany(Course::class, 'creator');
    }
}
