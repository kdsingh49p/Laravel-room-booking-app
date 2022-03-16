<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UregisterPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
    public function create(User $user)
    {
         return $user->type === 'admin';
         // if($user->type === 'merchant'){
         //    return TRUE  ; 
         // }else{
         //    return FALSE;
         // };
    }
}
