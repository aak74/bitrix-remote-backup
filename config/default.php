<?php
return [
    'backup_path' => '/mnt/b/backup',
    'host' => 'example.com',
    'user' => 'user',
    'port' => '22',
    'project_path' => '/var/www/html',
    'project_name' => 'some-project',
    'database' => [
        'provider' => 'bitrix',
    ],
    'php' => 'php',
    'public_key' => '~/.ssh/id_rsa.pub',
    'private_key' => '~/.ssh/id_rsa'
];
