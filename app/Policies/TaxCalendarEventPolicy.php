<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\TaxCalendarEvent;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaxCalendarEventPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TaxCalendarEvent');
    }

    public function view(AuthUser $authUser, TaxCalendarEvent $taxCalendarEvent): bool
    {
        return $authUser->can('View:TaxCalendarEvent');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TaxCalendarEvent');
    }

    public function update(AuthUser $authUser, TaxCalendarEvent $taxCalendarEvent): bool
    {
        return $authUser->can('Update:TaxCalendarEvent');
    }

    public function delete(AuthUser $authUser, TaxCalendarEvent $taxCalendarEvent): bool
    {
        return $authUser->can('Delete:TaxCalendarEvent');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:TaxCalendarEvent');
    }

    public function restore(AuthUser $authUser, TaxCalendarEvent $taxCalendarEvent): bool
    {
        return $authUser->can('Restore:TaxCalendarEvent');
    }

    public function forceDelete(AuthUser $authUser, TaxCalendarEvent $taxCalendarEvent): bool
    {
        return $authUser->can('ForceDelete:TaxCalendarEvent');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TaxCalendarEvent');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TaxCalendarEvent');
    }

    public function replicate(AuthUser $authUser, TaxCalendarEvent $taxCalendarEvent): bool
    {
        return $authUser->can('Replicate:TaxCalendarEvent');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TaxCalendarEvent');
    }

}