<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;

class ArticlePolicy extends Policy
{
    public function update(User $user, Article $article)
    {
        return $user->isAuthorOf($article);
    }

    public function destroy(User $user, Article $article)
    {
        return $user->is_admin || $user->isAuthorOf($article);
    }

    public function create(User $user)
    {
        return $user->is_admin;
    }
}
