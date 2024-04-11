<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        // \App\Models\Employee::create([
        //     'first_name' => 'Floyd',
        //     'last_name' => 'De Vera',
        //     'department_id' => '1',
        //     'email' => 'floyddevera@gmail.com',
        //     'password' => Hash::make('password'),
        //     'is_supervisor' => '1',
        // ]);
        // \App\Models\Equipment::create([
        //     'equipment_name' => 'ATEXCO',
        //     'equipment_type' => 'Printer',

        // ]);
        // \App\Models\Equipment::create([
        //     'equipment_name' => 'Tecjet Printer 1',
        //     'equipment_type' => 'Printer',

        // ]);
        // \App\Models\Equipment::create([
        //     'equipment_name' => 'Tecject Printer 2',
        //     'equipment_type' => 'Printer',

        // ]);
        // \App\Models\Equipment::create([
        //     'equipment_name' => 'EPSON',
        //     'equipment_type' => 'Printer',

        // ]);
          \App\Models\Department::create([
            'department_name' => 'Heat Press',
        ]);

        \App\Models\Department::create([
            'department_name' => 'Printing',
        ]);
        \App\Models\Department::create([
            'department_name' => 'Quality Control',
        ]);
        \App\Models\Department::create([
            'department_name' => 'Sewing',
        ]);

         \App\Models\Employee::create([
            'first_name' => 'Deither',
            'last_name' => 'Ramos',
            'department_id' => '3',
            'email' => 'deitherramos@gmail.com',
            'password' => Hash::make('password'),
            'is_supervisor' => '0',
        ]);
    }
}
