<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // \App\Models\Admin::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@admin.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'Quản trị viên',
        //     'group_id' => 1
        // ]);

        DB::table('modules')->insert([
            'name' => 'users',
            'title' => 'Quản lý người dùng',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('modules')->insert([
            'name' => 'groups',
            'title' => 'Quản lý nhóm',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('modules')->insert([
            'name' => 'posts',
            'title' => 'Quản lý bài viết',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('modules')->insert([
            'name' => 'products',
            'title' => 'Quản lý sản phẩm',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
