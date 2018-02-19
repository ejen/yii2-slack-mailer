<?php
return [
    'id' => 'test',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        'tests' => dirname(__DIR__),
    ],
    'container' => [
        'definitions' => [
//            \ejen\slack\mailer\SlackMessage::class => \ejen\slack\mailer\A::class,
            \understeam\slack\Client::class => \ejen\slack\mailer\FakeSlackClient::class
        ],
    ],
];
