<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\License;
use Illuminate\Auth\Access\HandlesAuthorization;

class LicensePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:License');
    }

    public function view(AuthUser $authUser, License $license): bool
    {
        return $authUser->can('View:License');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:License');
    }

    public function update(AuthUser $authUser, License $license): bool
    {
        return $authUser->can('Update:License');
    }

    public function delete(AuthUser $authUser, License $license): bool
    {
        return $authUser->can('Delete:License');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:License');
    }

    public function restore(AuthUser $authUser, License $license): bool
    {
        return $authUser->can('Restore:License');
    }

    public function forceDelete(AuthUser $authUser, License $license): bool
    {
        return $authUser->can('ForceDelete:License');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:License');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:License');
    }

    public function replicate(AuthUser $authUser, License $license): bool
    {
        return $authUser->can('Replicate:License');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:License');
    }

}