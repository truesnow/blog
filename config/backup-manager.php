<?php

return [
    'local' => [
        'type' => 'Local',
        'root' => storage_path('app'),
    ],
    's3' => [
        'type' => 'AwsS3',
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION'),
        'bucket' => env('AWS_BUCKET'),
        'root'   => '',
    ],
    'gcs' => [
        'type' => 'Gcs',
        'key'    => '',
        'secret' => '',
        'bucket' => '',
        'root'   => '',
    ],
    'rackspace' => [
        'type' => 'Rackspace',
        'username' => '',
        'key' => '',
        'container' => '',
        'zone' => '',
        'endpoint' => 'https://identity.api.rackspacecloud.com/v2.0/',
        'root' => '',
    ],
    'dropbox' => [
        'type' => 'DropboxV2',
        'token' => env('DROPBOX_TOKEN'),
        'key' => env('DROPBOX_KEY'),
        'secret' => env('DROPBOX_SECRET'),
        'app' => env('DROPBOX_APP'),
        'root' => env('DROPBOX_ROOT'),
    ],
    'ftp' => [
        'type' => 'Ftp',
        'host' => '',
        'username' => '',
        'password' => '',
        'port' => 21,
        'passive' => true,
        'ssl' => true,
        'timeout' => 30,
        'root' => '',
    ],
    'sftp' => [
        'type' => 'Sftp',
        'host' => '',
        'username' => '',
        'password' => '',
        'port' => 21,
        'timeout' => 10,
        'privateKey' => '',
        'root' => '',
    ],

    // Add additional options to dump-command (like '--max-allowed-packet')
    'command-extra-params' => env('BACKUP_MANAGER_EXTRA_PARAMS'),
];
