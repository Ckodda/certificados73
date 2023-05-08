<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $adminUser = new User();
        $adminUser->name = "Administrador";
        $adminUser->email = "mrivera@rc-consulting.org";
        $adminUser->password = Hash::make("Rcconsulting2661067");
        $adminUser->save();
    }
}
