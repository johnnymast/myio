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
        print_r($user->toArray());
        echo '^^';
        return [
            'Authorization' => 'Basic '.base64_encode($user->email.':'.$user->api_token)
        ];
    }
}
