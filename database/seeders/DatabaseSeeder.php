<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrNew(['email' => 'admin@example.com']);
        $admin->name = 'Admin';
        $admin->password = 'admin12345';   // di-hash otomatis oleh cast
        $admin->role = 'admin';
        $admin->save();
    }
}