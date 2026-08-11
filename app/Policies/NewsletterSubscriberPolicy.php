<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\NewsletterSubscriber;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsletterSubscriberPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:NewsletterSubscriber');
    }

    public function view(AuthUser $authUser, NewsletterSubscriber $newsletterSubscriber): bool
    {
        return $authUser->can('View:NewsletterSubscriber');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:NewsletterSubscriber');
    }

    public function update(AuthUser $authUser, NewsletterSubscriber $newsletterSubscriber): bool
    {
        return $authUser->can('Update:NewsletterSubscriber');
    }

    public function delete(AuthUser $authUser, NewsletterSubscriber $newsletterSubscriber): bool
    {
        return $authUser->can('Delete:NewsletterSubscriber');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:NewsletterSubscriber');
    }

    public function restore(AuthUser $authUser, NewsletterSubscriber $newsletterSubscriber): bool
    {
        return $authUser->can('Restore:NewsletterSubscriber');
    }

    public function forceDelete(AuthUser $authUser, NewsletterSubscriber $newsletterSubscriber): bool
    {
        return $authUser->can('ForceDelete:NewsletterSubscriber');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:NewsletterSubscriber');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:NewsletterSubscriber');
    }

    public function replicate(AuthUser $authUser, NewsletterSubscriber $newsletterSubscriber): bool
    {
        return $authUser->can('Replicate:NewsletterSubscriber');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:NewsletterSubscriber');
    }

}