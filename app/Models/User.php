<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'document',
        'username',
        'email',
        'password',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'type_document_identification_id',
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:Y-m-d h:i:s A',
        'updated_at' => 'datetime:Y-m-d h:i:s A',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
        'role_names',
        'permission_names',
    ];

    public function reports(): BelongsToMany
    {
        return $this->belongsToMany(Report::class, 'user_reports')
            ->withPivot('user_id', 'report_id');
    }

    public function type_identification(): HasOne
    {
        return $this->hasOne(TypeDocumentIdentification::class, 'id', 'type_document_identification_id');
    }

    public function getRoleNamesAttribute(): Collection
    {
        return $this->getRoleNames();
    }

    public function getPermissionNamesAttribute(): Collection
    {
        return $this->getAllPermissions()->pluck('name');
    }
}
