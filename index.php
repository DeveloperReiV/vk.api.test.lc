<?php

//require_once 'const.php';
require_once 'vkapi.php';

$api = new vkapi(APP_ID, SECRET_KEY, API_VERSION);

$friends_params = [
    'user_id' => 5639458
];

$friends = $api->api_query('friends.getOnline', $friends_params);
$friends_list = [];

foreach($friends->response as $item)
{
    $friend_params = [
        'user_id' => $item,
        'v' => '5.52',
        'fields' =>[
            'city',
            'bdate'
        ]
    ];

    $friends_list[] = $api->api_query('users.get', $friend_params);
}

echo "<pre>";
print_r($friends_list);
echo "</pre>";







