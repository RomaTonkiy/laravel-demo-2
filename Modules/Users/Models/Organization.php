<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Notifications\Notifiable;
use Modules\Courses\Models\Course;
use Modules\Users\Filters\OrganizationFilter;

class Organization extends BaseAuthenticatableUser
{
    use Notifiable;

    public const TABLE = 'organizations';

    public const GUARD = 'graph_organization';
    public const ROLE = 'organization';

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
        return OrganizationFilter::class;
    }

    public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class, 'organization_id');
    }

    public function courses(): MorphMany
    {
        return $this->morphMany(Course::class, 'creator');
    }
}
