<?php

return [
    'client_id' => env('LARADIT_OAUTH_CLIENT_ID'),
    'client_secret' => env('LARADIT_OAUTH_CLIENT_SECRET'),
    'oauth_redirect_uri' => env('LARADIT_OAUTH_REDIRECT_URI'),
    'user_agent' => /*env('LARADIT_USER_AGENT').*/str_random(40),
    'reddit_username' => env('LARADIT_REDDIT_USERNAME'),
    'reddit_password' => ENV('LARADIT_REDDIT_PASSWORD')
];