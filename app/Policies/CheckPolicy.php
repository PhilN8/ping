<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Check;
use App\Models\User;

final class CheckPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Check $check): bool
    {
        return $user->id === $check->service->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasVerifiedEmail();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Check $check): bool
    {
        return $user->id === $check->service->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Check $check): bool
    {
        return $user->id === $check->service->user_id;
    }
}
