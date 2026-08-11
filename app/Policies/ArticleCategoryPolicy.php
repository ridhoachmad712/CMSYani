<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ArticleCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticleCategoryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ArticleCategory');
    }

    public function view(AuthUser $authUser, ArticleCategory $articleCategory): bool
    {
        return $authUser->can('View:ArticleCategory');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ArticleCategory');
    }

    public function update(AuthUser $authUser, ArticleCategory $articleCategory): bool
    {
        return $authUser->can('Update:ArticleCategory');
    }

    public function delete(AuthUser $authUser, ArticleCategory $articleCategory): bool
    {
        return $authUser->can('Delete:ArticleCategory');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:ArticleCategory');
    }

    public function restore(AuthUser $authUser, ArticleCategory $articleCategory): bool
    {
        return $authUser->can('Restore:ArticleCategory');
    }

    public function forceDelete(AuthUser $authUser, ArticleCategory $articleCategory): bool
    {
        return $authUser->can('ForceDelete:ArticleCategory');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ArticleCategory');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ArticleCategory');
    }

    public function replicate(AuthUser $authUser, ArticleCategory $articleCategory): bool
    {
        return $authUser->can('Replicate:ArticleCategory');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ArticleCategory');
    }

}