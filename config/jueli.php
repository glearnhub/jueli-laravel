<?php

return [
    /*
    | First admin account created by `php artisan db:seed`.
    | In production a strong random password is generated and printed once if ADMIN_PASSWORD is not set.
    */
    'admin_name' => env('ADMIN_NAME', 'Admin'),
    'admin_email' => env('ADMIN_EMAIL', 'admin@jueli.test'),
    'admin_password' => env('ADMIN_PASSWORD'),
];
