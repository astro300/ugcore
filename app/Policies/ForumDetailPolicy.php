<?php

namespace UGCore\Policies;

use UGCore\Core\Entities\Forum\ForumComment;

use Illuminate\Auth\Access\HandlesAuthorization;
use UGCore\Core\Entities\Forum\ForumCommentDetail;
use UGCore\Core\Entities\Security\User;

class ForumDetailPolicy
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

    public function deleteDetail(User $user, ForumCommentDetail $comment)
    {
        return ($user->id == $comment->user_id  || $user->evaluateRoles(['SUPMIN'])>0);
    }

    public function ownerDetail(User $user, ForumCommentDetail $comment)
    {
        return ($user->id == $comment->user_id);
    }
}
