<?php

namespace Tests\Feature\Api;

use App\Hit;
use App\Link;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class StatisticsTest extends TestCase
{
    use DatabaseMigrations;

    protected $authType = 'basic';


    /**
     * @test
     *
     * Test: GET /api/statistics/link/{id}.
     */
    public function testHitsShow()
    {
        $user = factory(User::class)->create();
        $header = $this->authHeader($user);

        $link = factory(Link::class)
            ->create(['user_id' => $user->id]);

        /**
         * Test that status code 204 is given if
         * no hits are found for this link.
         */
        $this->get('api/statistics/link/'.$link->id, $header)
            ->assertStatus(204);

        factory(Hit::class, 4)
            ->create(['link_id' => $link->id]);

        /**
         * Assert that we see a status of 200 and the
         * hits created by the Hits factory.
         */
        $this->get('api/statistics/link/'.$link->id, $header)
            ->assertStatus(200)
            ->assertJsonStructure([
                'hits' => [
                    '*' => [
                    'id',
                    'link_id',
                    'ip',
                    'user_agent',
                    'created_at',
                    'updated_at'
                    ]
                ]
            ]);

        /**
         * Test that status code 404 is given if
         * the link is not found.
         */
        $this->get('api/statistics/link/non_existing_id', $header)
            ->assertStatus(404);
    }
}
