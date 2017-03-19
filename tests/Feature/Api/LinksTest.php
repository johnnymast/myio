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
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'user_id',
                        'url',
                        'hash',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);

        /**
         * Test to see if the output of api/links returns the
         * seeded links.
         *
         * Todo: Potential fail if we are going to implement pagination.
         */

        $this->get('/api/links', $header)
            ->assertExactJson(['data' => $testLinks->toArray()]);
    }


    /**
     * @test
     *
     * Test: POST /api/links.
     */
    public function testLinksStore()
    {
        $user = factory(User::class)->create();
        $header = $this->authHeader($user);

        $links = ['https://www.google.com', 'https://www.yahoo.com'];

        /**
         * Asset BadRequest if url or urls is not provided.
         * In this test we post the wrong key.
         */
        $this->post('api/links/', ['wrong' => 'parameter'], $header)
            ->assertStatus(400);

        // Failing parameters

        /**
         * Assert that we see a status of 201 and the
         * if we create one link using the required
         * url parameter.
         */
        $this->post('api/links/', ['url' => $links[0]], $header)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_id',
                    'url',
                    'hash',
                    'created_at',
                    'updated_at'
                ]
            ]);


        // 201 for created
    }


    /**
     * @test
     *
     * Test: POST /api/links.
     */
    public function testLinksShow()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $header = $this->authHeader($user1);

        $link1 = factory(Link::class)
            ->create(['user_id' => $user1->id]);

        $link2 = factory(Link::class)
            ->create(['user_id' => $user2->id]);

        /**
         * Assert that we see a status of 200 and the
         * seeds created by the Link factory.
         */
        $this->get('api/links/'.$link1->id, $header)
            ->assertStatus(200) // ->dump()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_id',
                    'url',
                    'hash',
                    'created_at',
                    'updated_at'
                ]
            ]);

        /**
         * Test that status code 200 is given if
         * the link has been found.
         */
        $this->get('api/links/'.$link1->id, $header)
            ->assertStatus(200)
            ->assertExactJson(['data' => $link1->toArray()]);


        /**
         * Test that status code 404 is given if
         * the link is owned by an other user then
         * the requesting user. This prevents a
         * potential security issue.
         *
         * Extra info:
         *  - $header contains auth information for
         *    $user1.
         */
        $this->get('api/links/'.$link2->id, $header)
            ->assertStatus(404);
    }


    public function testLinksDestroy()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $header = $this->authHeader($user1);

        $link1 = factory(Link::class)
            ->create(['user_id' => $user1->id]);

        $link2 = factory(Link::class)
            ->create(['user_id' => $user2->id]);


        /**
         * Test that status code 200 is given if
         * the link has been found.
         */
        $this->delete('api/links/'.$link1->id, [],$header)
            ->assertStatus(200)
            ->assertSee('OK');


        /**
         * Test that a non existing link would
         * trigger a 404
         */
        $this->delete('api/links/'.'non_existing', [],$header)
            ->assertStatus(404);

        /**
         * Test that would trying to delete a link that
         * is not owned by the authenticated user
         * will return in a 404 error.
         *
         * Extra info:
         *  - $header contains auth information for
         *    $user1. This means link2 should not
         *    be found because link2 is owned by
         *    $user2.
         */
        $this->delete('api/links/'.$link2->id, [],$header)
            ->assertStatus(404);
    }
}
