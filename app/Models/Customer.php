<?php

namespace App\Models;

use App\Contracts\Cnpja\HasCnpjData;
use App\Models\Scopes\TenantScope;
use App\Models\Traits\HasCnpjDataTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Builder, Model, Relations\BelongsTo};

/**
 * @property string $id
 * @property string $tenant_id
 * @property string $user_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $tax_id
 * @property string $city
 * @property string $state
 * @property string $zipcode
 * @property bool $is_active
 */
class Customer extends Model implements HasCnpjData
{
    use HasFactory;
    use HasUlids;
    use HasCnpjDataTrait;

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted(): void
    {
        static::addGlobalScope(new TenantScope());
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
     * Escopo para selecionar apenas os clientes ativos.
     *
     * @param Builder<Customer> $query
     * @return Builder<Customer>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Escopo para selecionar apenas os clientes inativos.
     *
     * @param Builder<Customer> $query
     * @return Builder<Customer>
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('is_active', false);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Formata o CPF ou CNPJ.
     *
     * @return Attribute<string, never>
     */
    protected function formattedCpfCnpj(): Attribute
    {
        return Attribute::make(
            get: static function ($value, $attributes): string {
                if (is_array($attributes) && isset($attributes['tax_id'])) {
                    $cpfCnpj = $attributes['tax_id'];

                    if (strlen($cpfCnpj) === 11) {
                        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpfCnpj);
                    }

                    return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cpfCnpj);
                }

                return '';
            }
        );
    }

}
