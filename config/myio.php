<?php

return [
    'general' => [
        'hash_length' => 16,
        'mail_token_length' => 16,
    ],
    'admin' => [
        'pagination' => [
            'items_per_page' => 10,
        ],
        'user_create' => [
            'default_activate_user' => true,
        ],
    ],
];
