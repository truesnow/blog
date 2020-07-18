<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WikiSubject;
use Illuminate\Auth\Access\HandlesAuthorization;

class WikiSubjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the wikiSubject.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WikiSubject  $wikiSubject
     * @return mixed
     */
    public function view(User $user, WikiSubject $wikiSubject)
    {
        //
    }

    /**
     * Determine whether the user can create wikiSubjects.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the wikiSubject.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WikiSubject  $wikiSubject
     * @return mixed
     */
    public function update(User $user, WikiSubject $wikiSubject)
    {
        //
    }

    /**
     * Determine whether the user can delete the wikiSubject.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\WikiSubject  $wikiSubject
     * @return mixed
     */
    public function delete(User $user, WikiSubject $wikiSubject)
    {
        //
    }
}
