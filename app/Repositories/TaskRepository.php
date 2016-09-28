<?php

namespace App\Repositories;

use App\User;
use App\Task;

class TaskRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Task::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
   /**
     * Get one of the task by id
     *
     * @param  $id
     * @return Collection
     */
    public function taskById($id)
    {
        return Task::where('id', $id)
                    ->get();
    }
}
