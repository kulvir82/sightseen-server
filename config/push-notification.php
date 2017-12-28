<?php

return array(

    'IOS' => array(
        'environment' =>'development',
        'certificate' =>'../apns-go4ss-dev.pem',
        'passPhrase'  =>'go4ss563',
        'service'     =>'apns'
    ),
    'Android' => array(
        'environment' =>'production',
        'apiKey'      =>'yourAPIKey',
        'service'     =>'gcm'
    )

);

