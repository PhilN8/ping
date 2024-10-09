<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Credential extends Model
{
    /** @use HasFactory<\Database\Factories\CredentialFactory> */
    use HasFactory;
    use HasUlids;

    /** @var array<int,string> */
    protected $fillable = [
        'name',
        'type',
        'value',
        'user_id',
    ];

    /** @return BelongsTo<User> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    /** @return HasMany<Check> */
    public function checks(): HasMany
    {
        return $this->hasMany(
            related: Check::class,
            foreignKey: 'credential_id',
        );
    }

    /** @var array<string,string> */
    protected function casts(): array
    {
        return [
            'type' => 'array',
            'value' => 'encrypted',
        ];
    }
}
