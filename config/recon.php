<?php

return [
    'secret_key' => env('RECON_SECRETKEY', null),
    'mer_code'   => env('RECON_MERCODE', null),
    'recon_url'  => env('RECON_URL', null),
    'return_url' => env('RECON_RETURLURL', null),
    'notify_url' => env('RECON_NOTIFYLURL', null),
    'timeout'    => env('RECON_TIMEOUT', null),
];
