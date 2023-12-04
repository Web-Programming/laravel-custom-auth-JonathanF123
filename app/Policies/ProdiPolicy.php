<?php

namespace App\Policies;

use App\Models\User;
use App\Models\prodi;
use Illuminate\Auth\Access\Response;

class ProdiPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, prodi $prodi): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        // return $user->email== 'jonathanfelixlevid@gmail.com';
        return in_array($user->email, [
            'jonathanfelixlevid@gmail.com',
            'siapakamu@gmail.com'
        ]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, prodi $prodi): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, prodi $prodi): bool
    {
        //
        return in_array($user->email, [
            'jonathanfelixlevid@gmail.com',
        ]);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, prodi $prodi): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, prodi $prodi): bool
    {
        //
    }
}