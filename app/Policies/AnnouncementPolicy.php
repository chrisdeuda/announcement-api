<?php

namespace App\Policies;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnouncementPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any announcements.
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the announcement.
     *
     * @param  User  $user
     * @param  Announcement  $announcement
     * @return mixed
     */
    public function view(User $user, Announcement $announcement)
    {
        //
    }

    /**
     * Determine whether the user can create announcements.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // Any user will automatically as logged in
        try {
            $user = auth()->userOrFail();
            return true;
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            // do something
            return false;
        }


    }

    /**
     * Determine whether the user can update the announcement.
     *
     * @param  User  $user
     * @param  Announcement  $announcement
     * @return mixed
     */
    public function update(User $user, Announcement $announcement)
    {

        return true;
        // Any user will automatically as logged in
        try {
            $user = auth()->userOrFail();
            return true;
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            // do something
            return false;
        }
    }

    /**
     * Determine whether the user can delete the announcement.
     *
     * @param  App\User  $user
     * @param  App\Announcement  $announcement
     * @return mixed
     */
    public function delete(User $user, Announcement $announcement)
    {
        //
    }
}
