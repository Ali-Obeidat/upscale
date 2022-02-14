<?php

namespace Database\Seeders;
use \App\Models\User;
use \App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
        ]);
        $this->call([
            AdminSeeder::class,
            RoleSeeder::class,
            
        ]);
        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}
