<?php

namespace Tests\Feature\Api;

use App\Link;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LinksTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     * @dataProvider
     *
     * Test: GET /api/links.
     */
    public function testLinksIndex()
    {

        $this->seed('ApiUsersTableSeeder');

        $this->get('api/links', $this->withBasicAuthHeader())->assertStatus(200)->assertJson([]);

        $this->seed('ApiLinksTableSeeder');

        /**
         * Assert that we see a status of 200 and the
         * seeds created by ApiLinksTableSeeder.
         */
        $this->get('api/links', $this->withBasicAuthHeader())->assertStatus(200)->assertJsonStructure([
            '*' => [
                'user_id',
                'url',
                'hash',
                'created_at',
                'updated_at'
            ]
        ]);

        $x = $this->get('api/links', $this->withBasicAuthHeader())->assertStatus(200)->assertJson([
           ]);

        /**
         * Test to see if the output of api/links returns the
         * seeded links.
         */
        $this->get('api/links', $this->withBasicAuthHeader())->assertStatus(200)
            ->assertJson(Link::all()->toArray());

    }


    public function testLinksStore()
    {

    }


    public function testLinksShow()
    {

    }


    public function testLinksDestroy()
    {

    }
}
