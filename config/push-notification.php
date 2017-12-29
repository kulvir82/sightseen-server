<?php

return array(

    'IOS' => array(
        'environment' =>'development',
        'certificate' =>'/var/www/apns-go4ss-prod.pem',
        'passPhrase'  =>'go4ss563',
        'service'     =>'apns'
    ),
    'Android' => array(
        'environment' =>'production',
        'apiKey'      =>'yourAPIKey',
        'service'     =>'gcm'
    )

);

