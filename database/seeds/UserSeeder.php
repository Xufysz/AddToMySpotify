<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Factory(User::class, 1)->create(['name' => 'Kyle', 'email' => 'kyle.rusby@gmail.com']);
    }
}
