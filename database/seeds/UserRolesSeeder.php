<?php

use App\Role;
use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Role::class)->create(['name' => 'Administrator']);
        factory(Role::class)->create(['name' => 'User']);
    }
}
