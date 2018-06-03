<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;

class ArticlePolicy extends Policy
{
    public function update(User $user, Article $article)
    {
        return $user->is_admin;
    }

    public function destroy(User $user, Article $article)
    {
        return $user->is_admin;
    }
}
