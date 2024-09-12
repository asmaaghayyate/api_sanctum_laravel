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
        \App\Models\categorie::factory(10)->create();

      /* \App\Models\categorie::factory()->create([

        'name'=>'name1',
        'description'=>'description1'
       ]);*/

}
}