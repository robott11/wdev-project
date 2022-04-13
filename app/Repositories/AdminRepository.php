<?php

namespace App\Repositories;

use App\Models\Admin;

class AdminRepository
{
    public function getAdminByEmail(string $email): Admin|null
    {
        return Admin::where('email', '=', $email)->first();
    }
}
