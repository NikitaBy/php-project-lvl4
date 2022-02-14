<?php

namespace App\Policies;

use App\Models\Label;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class LabelPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return Auth::check();
    }

    public function delete(User $user, Label $label): bool
    {
        return Auth::check();
    }

    public function forceDelete(User $user, Label $label): bool
    {
        return false;
    }

    public function restore(User $user, Label $label): bool
    {
        return false;
    }

    public function update(User $user, Label $label): bool
    {
        return Auth::check();
    }

    public function view(?User $user, Label $label): bool
    {
        return true;
    }

    public function viewAny(?User $user): bool
    {
        return true;
    }
}
