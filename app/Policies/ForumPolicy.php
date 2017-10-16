<?php

namespace UGCore\Policies;

use UGCore\Core\Entities\Forum\ForumComment;

use Illuminate\Auth\Access\HandlesAuthorization;
use UGCore\Core\Entities\Security\User;

class ForumPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function delete(User $user, ForumComment $comment)
    {
        return ($user->id == $comment->user_id  || $user->evaluateRoles(['SUPMIN'])>0);
    }

    public function owner(User $user, ForumComment $comment)
    {
        return ($user->id == $comment->user_id);
    }
}
