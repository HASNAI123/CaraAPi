<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;



use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
   {
       User::factory()->count(10)->create();
   }
}
