<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomepageTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testHomepage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Welcome To MyIO');
        });
    }
}
