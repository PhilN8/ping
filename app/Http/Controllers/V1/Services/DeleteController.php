<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Services;

use App\Http\Responses\V1\MessageResponse;
use App\Jobs\Services\DeleteService;
use App\Models\Service;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

final readonly class DeleteController
{
    public function __construct(
        private Dispatcher $bus,
    ) {}

    public function __invoke(Request $request, Service $service): Responsable
    {
        if ( ! Gate::allows('delete', $service)) {
            throw new UnauthorizedException(
                message: 'You cannot delete a service you do not own',
                code: Response::HTTP_FORBIDDEN,
            );
        }

        $this->bus->dispatch(
            command: new DeleteService(
                service: $service,
            ),
        );

        return new MessageResponse(
            message: 'Your service will be deleted in the background.',
            status: Response::HTTP_ACCEPTED,
        );
    }
}
