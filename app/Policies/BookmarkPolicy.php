<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Bookmark;

class BookmarkPolicy extends Policy
{
    public function update(User $user, Bookmark $bookmark)
    {
        // return $bookmark->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Bookmark $bookmark)
    {
        return true;
    }
}
