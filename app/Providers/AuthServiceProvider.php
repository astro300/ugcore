<?php

namespace UGCore\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use UGCore\Core\Entities\Forum\ForumComment;
use UGCore\Core\Entities\Forum\ForumCommentDetail;
use UGCore\Policies\ForumDetailPolicy;
use UGCore\Policies\ForumPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        ForumComment::class=>ForumPolicy::class,
        ForumCommentDetail::class=>ForumDetailPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
