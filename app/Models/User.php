<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Contracts\Cnpja\HasCnpjData;
use App\Models\Permission\Role;
use App\Models\Scopes\TenantScope;
use App\Models\Traits\HasCnpjDataTrait;
use App\Permission\HasRoles;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property ?Carbon $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $tenant_id
 * @property string $roles
 */
class User extends Authenticatable implements HasCnpjData
{
    use HasFactory;
    use Notifiable;
    use HasUlids;
    use HasApiTokens;
    use HasCnpjDataTrait;
    use HasRoles;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function booted(): void
    {
        static::addGlobalScope(new TenantScope());
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEntityType(): string
    {
        return get_class($this);
    }

    /**
     * The roles that belong to the user.
     *
     * @return BelongsToMany<Role>
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)
            ->where(function ($query) {
                $query->whereNull('tenant_id')
                ->orWhere('tenant_id', $this->tenant_id);
            });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

}
