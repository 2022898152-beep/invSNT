<?php

namespace App\Policies;

use App\Models\Employeeship;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeeshipPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_employeeship');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Employeeship $employeeship): bool
    {
        return $user->can('view_employeeship');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_employeeship');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Employeeship $employeeship): bool
    {
        return $user->can('update_employeeship');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Employeeship $employeeship): bool
    {
        return $user->can('delete_employeeship');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_employeeship');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Employeeship $employeeship): bool
    {
        return $user->can('force_delete_employeeship');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_employeeship');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Employeeship $employeeship): bool
    {
        return $user->can('restore_employeeship');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_employeeship');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Employeeship $employeeship): bool
    {
        return $user->can('replicate_employeeship');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_employeeship');
    }
}
