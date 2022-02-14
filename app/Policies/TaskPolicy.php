<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TaskPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return Auth::check();
    }

    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->created_by_id;
    }

    public function forceDelete(User $user, Task $task): bool
    {
        return false;
    }

    public function restore(User $user, Task $task): bool
    {
        return false;
    }

    public function update(User $user, Task $task): bool
    {
        return Auth::check();
    }

    public function view(?User $user, Task $task): bool
    {
        return true;
    }

    public function viewAny(?User $user): bool
    {
        return true;
    }
}
