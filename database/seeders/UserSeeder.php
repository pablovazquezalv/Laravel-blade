<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Crypt;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //admin
        //puede crear tickets, asignar tickets a tecnicos, ver tickets, editar tickets, eliminar tickets
        //ver roles y usuarios, editar roles y usuarios
        DB::table('users')->insert([
            'name' => 'admin1',
            'last_name' => 'laravel',
            'email' => 'anderpiter07@gmail.com',
            'phone_number' => '1234567890',
            'code' =>  Crypt::encryptString('1010'),
            'password' => bcrypt('123456789'),
            'rol_id' => 1,
            'public_key' => Crypt::encryptString('123456789'),
           // 'private_key' => Crypt::encryptString('123456789'),
            'status' => true,
        ]);

        //coordinator
        //puede  crear tickets, asignar tickets a tecnicos, ver tickets, editar tickets, eliminar tickets
        DB::table('users')->insert([
            'name' => 'coordinator2',
            'last_name' => 'exalariacrew',
            'email' => 'pabloalvaradovazquez10@hotmail.com',
            'phone_number' => '1234567890',
            'code' =>  Crypt::encryptString('1030'),
            'password' => bcrypt('123456789'),
            'rol_id' => 2,
            'status' => true,
        ]);

        //solo ver tickets
        DB::table('users')->insert([
            'name' => 'guest3',
            'last_name' => 'pablo',
            'email' => 'pabloalvaradovazquez10@gmail.com',
            'phone_number' => '1234567890',
            'password' => bcrypt('123456789'),
            'code' =>  Crypt::encryptString('1050'),
            'rol_id' => 3,
            'status' => true,
        ]);



    }
}
