<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\SendPing;
use App\Models\Check;
use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\Dispatcher;

use function Laravel\Prompts\info;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'ping', description: 'Run through all checks and perform a ping check')]
final class Ping extends Command
{
    public function handle(Dispatcher $bus): void
    {
        info(
            message: 'Starting to ping the universe...',
        );

        $checks = Check::query()->get();

        foreach (Check::query()->cursor() as $check) {
            info(
                message: "Dispatching ping: {$check->id}.",
            );

            $bus->dispatchNow(
                command: new SendPing(
                    check: $check,
                ),
            );
        }
    }
}
