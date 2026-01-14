<?php

namespace App\Policies;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DoctoresPolicy
{
    use HandlesAuthorization;

    // ✅ MÉTODOS EXACTOS que usa tu middleware
    public function adminDoctoresIndex(User $user)
    {
        return true;  // Permite a todos (cámbialo después)
    }

    public function adminDoctoresCreate(User $user)
    {
        return true;
    }

    public function adminDoctoresStore(User $user)
    {
        return true;
    }

    public function adminDoctoresReportes(User $user)
    {
        return true;
    }

    public function adminDoctoresShow(User $user, Doctor $doctor)
    {
        return true;
    }

    public function adminDoctoresEdit(User $user, Doctor $doctor)
    {
        return true;
    }

    public function adminDoctoresUpdate(User $user, Doctor $doctor)
    {
        return true;
    }

    public function adminDoctoresConfirmDelete(User $user, Doctor $doctor)
    {
        return true;
    }

    public function adminDoctoresDestroy(User $user, Doctor $doctor)
    {
        return true;
    }
}
