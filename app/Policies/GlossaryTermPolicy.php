<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\GlossaryTerm;
use Illuminate\Auth\Access\HandlesAuthorization;

class GlossaryTermPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:GlossaryTerm');
    }

    public function view(AuthUser $authUser, GlossaryTerm $glossaryTerm): bool
    {
        return $authUser->can('View:GlossaryTerm');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:GlossaryTerm');
    }

    public function update(AuthUser $authUser, GlossaryTerm $glossaryTerm): bool
    {
        return $authUser->can('Update:GlossaryTerm');
    }

    public function delete(AuthUser $authUser, GlossaryTerm $glossaryTerm): bool
    {
        return $authUser->can('Delete:GlossaryTerm');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:GlossaryTerm');
    }

    public function restore(AuthUser $authUser, GlossaryTerm $glossaryTerm): bool
    {
        return $authUser->can('Restore:GlossaryTerm');
    }

    public function forceDelete(AuthUser $authUser, GlossaryTerm $glossaryTerm): bool
    {
        return $authUser->can('ForceDelete:GlossaryTerm');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:GlossaryTerm');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:GlossaryTerm');
    }

    public function replicate(AuthUser $authUser, GlossaryTerm $glossaryTerm): bool
    {
        return $authUser->can('Replicate:GlossaryTerm');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:GlossaryTerm');
    }

}