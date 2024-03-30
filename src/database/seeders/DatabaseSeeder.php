<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = new User;
        $user->username = 'admin';
        $user->email = 'pakiyaasiv1@gmail.com'; // replace with the admin's email
        $user->password = bcrypt('asas'); // the password will be hashed before being stored in the database
        $user->email_verified_at = null; // set email_verified_at to null
        $user->remember_token = null; // set remember_token to null
        $user->created_at = now(); // set created_at to current time
        $user->updated_at = now(); // set updated_at to current time
        $user->save();
    }
}
