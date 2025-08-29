<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SoilTest;

class SoilTestPolicy
{
    public function view(User $user, SoilTest $soilTest)
    {
        return $user->id === $soilTest->user_id || $user->hasRole('admin');
    }

    public function create(User $user)
    {
        return $user->hasRole('farmer') || $user->hasRole('admin');
    }

    public function update(User $user, SoilTest $soilTest)
    {
        return $user->id === $soilTest->user_id || $user->hasRole('admin');
    }

    public function delete(User $user, SoilTest $soilTest)
    {
        return $user->id === $soilTest->user_id || $user->hasRole('admin');
    }

    public function manageVendorOperations(User $user, SoilTest $soilTest)
    {
        return $user->hasRole('vendor_staff') && 
               $user->vendor_id === $soilTest->vendor_id;
    }
}
