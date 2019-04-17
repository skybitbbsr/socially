<?php

return [

    'facebook' => [
        'app_id' => env("FACEBOOK_APP_ID"),
        'app_secret' => env("FACEBOOK_APP_SECRET"),
        'default_graph_version' => env("FACEBOOK_DEFAULT_GRAPH_VERSION"),
        'app_redirect_uri' =>env('FACEBOOK_REDIRECT_URI')
    ],
    'google' => [
        'app_id' => env("GOOGLE_APP_CLIENT_ID"),
        'app_secret' => env("GOOGLE_APP_CLIENT_SECRET"),
        'app_name' => env("GOOGLE_APP_NAME"),
        'app_redirect_uri' =>env('GOOGLE_REDIRECT_URI'),
        'app_scopes' => explode(', ', env('GOOGLE_APP_SCOPE', 'profile, email, openid'))
    ]

];