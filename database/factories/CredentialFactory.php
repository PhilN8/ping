<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\CredentialType;
use App\Models\Credential;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Credential>
 */
final class CredentialFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Credential::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'type' => [
                'type' => CredentialType::Bearer_Auth,
                'prefix' => 'Bearer',
            ],
            'value' => $this->faker->uuid(),
            'user_id' => User::factory(),
        ];
    }
}
