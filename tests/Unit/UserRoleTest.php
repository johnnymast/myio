<?php

namespace Tests\Unit;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserRoleTest extends TestCase
{
    use DatabaseMigrations;

    /** @test **/
    public function can_create_user_as_an_administrator()
    {
        $role = factory(Role::class)->create();

        $user = factory(User::class)->create([
            'name'  => 'Jonny admin',
            'email' => 'jonny@myio.com',
        ]);

        $user->assignRole($role);

        $this->assertTrue($user->hasRole('Administrator'));
    }

    /** @test **/
    public function can_create_normal_user()
    {
        $role = factory(Role::class)->create(['name' => 'User']);

        $user = factory(User::class)->create([
            'name'  => 'Jane User',
            'email' => 'jane@myio.com',
        ]);

        $user->assignRole($role);

        $this->assertTrue($user->hasRole('User'));
    }

    /** @test **/
    public function normal_user_cannot_have_administrtaor_role()
    {
        $role = factory(Role::class)->create(['name' => 'User']);

        $user = factory(User::class)->create([
            'name'  => 'Jane User',
            'email' => 'jane@myio.com',
        ]);

        $this->assertFalse($user->hasRole('Administrator'));
    }
}
