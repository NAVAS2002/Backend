<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
{
    public function run()
    {
        

        // Usuario Mesero
        $meseroUserId = DB::table('users')->insertGetId([
            'nombre' => 'Mesero Juan',
            'email' => 'mesero@example.com',
            'password' => Hash::make('admin123'),
            'rol' => 'mesero',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('meseros')->insert([
            'id_usuario' => $meseroUserId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Usuario Cocinero
        $cocineroUserId = DB::table('users')->insertGetId([
            'nombre' => 'Cocinero Ana',
            'email' => 'cocinero@example.com',
            'password' => Hash::make('admin123'),
            'rol' => 'cocinero',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cocineros')->insert([
            'id_usuario' => $cocineroUserId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Usuario Cliente
        $clienteUserId = DB::table('users')->insertGetId([
            'nombre' => 'Cliente Pedro',
            'email' => 'cliente@example.com',
            'password' => Hash::make('admin123'),
            'rol' => 'cliente',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('clientes')->insert([
            'id_usuario' => $clienteUserId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

