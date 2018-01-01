<?php

return array(

    'IOS' => array(
        'environment' =>'production',
        'certificate' =>'/var/www/apns-go4ss-prod.pem',
        'passPhrase'  =>'go4ss',
        'service'     =>'apns'
    ),
    'Android' => array(
        'environment' =>'production',
        'apiKey'      =>'yourAPIKey',
        'service'     =>'gcm'
    )

);

