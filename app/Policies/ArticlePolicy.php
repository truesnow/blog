<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;

class ArticlePolicy extends Policy
{
    public function update(User $user, Article $article)
    {
        return $user->id == $article->user_id;
    }

    public function destroy(User $user, Article $article)
    {
        return $user->is_admin || $user->id == $article->user_id;
    }

    public function create(User $user)
    {
        return $user->is_admin;
    }
}
