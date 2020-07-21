<?php

/**
 * 访问记录配置
 */
return [
    /**
     * 不记录的路径
     */
    'except' => [
        'paths' => [
            'register', 'signup', 'login', 'signin', 'password_reset'
        ],
        'prefixs' => [
            'admin',
            '_debugbar'
        ]
    ]
];