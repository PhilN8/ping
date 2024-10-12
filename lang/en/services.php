<?php

declare(strict_types=1);

return [
    'v1' => [
        'create' => [
            'success' => 'Your service will be created in the background.',
            'failure' => 'You must verify your email before creating a new service',
        ],
        'show' => [
            'failure' => 'You cannot view a service that you do not own.',
        ],
        'update' => [
            'success' => 'We will update your service in the background.',
            'failure' => 'You cannot update a service you do not own',
        ],
        'delete' => [
            'success' => 'We will delete your service in the background.',
            'failure' => 'You cannot delete a service you do not own',
        ],
    ],
];
