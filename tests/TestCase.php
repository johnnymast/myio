<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    use CreatesApplication;

    protected $authType = 'basic';


    protected function authHeader($user = null)
    {
        if ( ! $user) {
            $user = User::first();
        }

        if ($this->authType == 'basic') {
            return [
                'Authorization' => 'Basic '.base64_encode($user->email.':'.$user->api_token)
            ];
        }

        return [];
    }
}
