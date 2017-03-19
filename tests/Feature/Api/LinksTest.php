<?php

namespace Tests\Feature\Api;

use App\Link;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LinksTest extends TestCase
{
    use DatabaseMigrations;

    protected $authType = 'basic';

    /**
     * @test
     *
     * Test: GET /api/links.
     */
    public function testLinksIndex()
    {

        $user = factory(User::class)->create();
        $header = $this->authHeader($user);

        /**
         * Test that status code 204 is given if
         * there is no content found.
         */
        $this->get('api/links', $header)
            ->assertStatus(204);

        $testLinks = factory(Link::class, 2)
            ->create(['user_id' => $user->id]);

        /**
         * Assert that we see a status of 200 and the
         * seeds created by the Link factory.
         */
        $this->get('api/links', $header)
            ->assertStatus(200) //->dump()
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'user_id',
                    'url',
                    'hash',
                    'created_at',
                    'updated_at'
                ]
            ]);

        /**
         * Test to see if the output of api/links returns the
         * seeded links.
         *
         * Todo: Potential fail if we are going to implement pagination.
         */

        // assertJson success
        // assertExactJson fails
        $this->get('/api/links', $header)->assertJson($testLinks->toArray());
    }


    /**
     * @test
     *
     * Test: POST /api/links.
     */
    public function testLinksStore()
    {
        // 201 for created
    }


    /**
     * @test
     *
     * Test: POST /api/links.
     */
    public function testLinksShow()
    {
        $user = factory(User::class)->create();
        $header = $this->authHeader($user);

        $link = factory(Link::class)
            ->create(['user_id' => $user->id]);

        /**
         * Test that status code 200 is given if
         * the link has been found.
         */
        $this->get('api/links/'.$link->id, $header)->dump()
            ->assertStatus(200)
            ->assertJson($link->toArray());



     //   dd(\App\Link::all()->toArray());
    }


    public function testLinksDestroy()
    {

    }
}
