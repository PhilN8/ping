<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Check;
use App\Models\Service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Pirlo',
            'email' => 'pirlo@nya.ga',
        ]);

        $service = Service::factory()->for($user)->create([
            'name' => 'Treblle API',
            'url' => 'https://treblle.com',
        ]);

        Check::factory()->for($service)->count(1)->create([
            'name' => 'Root check',
            'path' => '/hello',
            'method' => 'GET',
            'headers' => [
                'User-Agent' => 'Treblle Ping Service 1.0.0',
            ],
        ]);
    }
}
