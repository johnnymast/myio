<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function withBasicAuthHeader($user = null) {
        if (! $user) {
            $user = User::first();
        }

        return [
            'Authorization' => 'Basic '.base64_encode($user->email.':'.$user->api_token)
        ];
    }
}
