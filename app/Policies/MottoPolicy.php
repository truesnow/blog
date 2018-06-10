<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Motto;

class MottoPolicy extends Policy
{
    public function update(User $user, Motto $motto)
    {
        // return $motto->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Motto $motto)
    {
        return true;
    }
}
