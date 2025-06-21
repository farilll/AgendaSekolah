<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData =[
            [
            'name'=>'Siswa',
            'email'=>'siswa@gmail.com',
            'role'=>'siswa',
            'password'=>bcrypt('siswa123')
            ],
            [
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'role'=>'admin',
            'password'=>bcrypt('admin123')
            ],
            [
            'name'=>'Guru',
            'email'=>'guru@gmail.com',
            'role'=>'guru',
            'password'=>bcrypt('guru123')
            ]
        ];

        foreach($userData as $key => $val)
        {
            User::create($val);
        };
    }

}